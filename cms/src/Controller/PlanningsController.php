<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Planning;
use DateTime;
use DateTimeImmutable;

/**
 * Plannings Controller
 *
 */
class PlanningsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->fetchTable('Plannings')->find('all')->contain('Lessons');
        $plannings = $this->paginate($query);

        $this->set(compact('plannings'));
    }

    /**
     * View method
     *
     * @param string|null $id Planning id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $planning = $this->Plannings->get($id, contain: []);
        $this->set(compact('planning'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $planning = $this->Plannings->newEmptyEntity();
        if ($this->request->is('post')) {
            $planning = $this->Plannings->patchEntity($planning, $this->request->getData());
            if ($this->Plannings->save($planning)) {
                $this->Flash->success(__('The planning has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The planning could not be saved. Please, try again.'));
        }
        $this->set(compact('planning'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Planning id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $planning = $this->Plannings->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $planning = $this->Plannings->patchEntity($planning, $this->request->getData());
            if ($this->Plannings->save($planning)) {
                $this->Flash->success(__('The planning has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The planning could not be saved. Please, try again.'));
        }
        $this->set(compact('planning'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Planning id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $planning = $this->Plannings->get($id);
        if ($this->Plannings->delete($planning)) {
            $this->Flash->success(__('The planning has been deleted.'));
        } else {
            $this->Flash->error(__('The planning could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function assign(int $id)
    {
        $this->request->allowMethod(['put']);
        
        $data = $this->request->getData();

        $horseIds = [];
        foreach ($data as $key => $horseId) {
            // Bypass the validation if this value is Blank.
            if ($horseId < 0) {
                continue;
            }

            // Duplicate horse assignment for the same lesson.
            if (in_array($horseId, $horseIds)) {
                $this->Flash->error(h("You cannot select a horse twice for one lesson."));
                return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
            }

            $horseIds[] = $horseId;
        }

        $planning = $this->Plannings->findById($id)->contain(['Lessons', 'Lessons.Horses'])->first();
        $session = $this->request->getSession();
        $session->write('lesson.selected', $id);

        // Clear the relations between horses and this planning.
        foreach ($planning->lessons as $lesson) {
            $lesson->horses = [];
        }

        // Free the horses for this planning before calculating horse working time.
        $this->Plannings->save($planning);
        // Retrieve horses to assign them to the planning lessons.
        $horses = $this->fetchTable('Horses')->find()->contain(['Lessons', 'Lessons.Plannings']);

        $selectedHorseIds = [];
        $selectedHorses = [];

        // Add in a list all selected horse identifiers.
        foreach (array_keys($data) as $key) {
            if (str_starts_with($key, 'horse') && $data[$key] != '-1') {
                $selectedHorseIds[] = $data[$key];
            }
        }
        
        // Store every selected horses in a temporary list.
        foreach ($horses as $horse) {
            if (in_array($horse->id, $selectedHorseIds)) {
                $selectedHorses[] = $horse;
            }
        }

        // Iterate on each horse to calculate its working time.
        foreach ($selectedHorses as $horse) {
            $totalWorkingSeconds = 0;
            $maxWorkingSeconds = $horse->max_working_hours * 3600;

            // Calculate the total amount of time the horse already works.
            foreach ($horse->lessons as $l) {
                $duration = $l->planning->end_datetime->getTimestamp() - $l->planning->start_datetime->getTimestamp();
                $totalWorkingSeconds += $duration;
            }

            $remainingWorkingSeconds = $maxWorkingSeconds - $totalWorkingSeconds;

            // Return an error if a horse works more than its maximum working hours.
            if ($remainingWorkingSeconds < 1) {
                $this->Flash->error("The horse " . ucfirst($horse->name) . " cannot work today anymore.");
                return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
            }
        }

        foreach ($selectedHorses as $horse) {
            foreach ($planning->lessons as $lesson) {
                // Go to the next lesson of the planning, the current one has already all required horses.
                if ($lesson->number_of_riders == count($lesson->horses)) {
                    continue;
                }

                $lesson->horses[] = $horse;
                break;
            }
        }

        foreach ($planning->lessons as $lesson) {
            $this->fetchTable('Lessons')->save($lesson);
        }

        if ($this->Plannings->save($planning)) {
            $this->Flash->success(date_format($planning->start_datetime, 'H:i') . ' - ' . date_format($planning->end_datetime, 'H:i') . ' : ' . __('The lesson has been saved.'));
        }

        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
    }

    public function generatePlanningOfTheYear()
    {
        $year = date_format(new DateTime('now'), 'Y');
        $plannings = $this->fetchTable('Plannings')->find('all')->where(['start_datetime >= ' => date('Y-m-d', strtotime('first day of january this year'))])->toArray();
        $newPlannings = [];

        $date1 = "01-01-$year";
        $date2 = "01-01-" . $year + 1;
        
        if (empty($plannings)) {
            for ($currenDate = strtotime($date1); $currenDate < strtotime($date2); $currenDate += (86400)) {
                for ($i=10; $i<18; $i++) {
                    $newPlannings[] = new Planning([
                        'start_datetime' => date('Y-m-d H:i:s', $currenDate + 3600 * $i),
                        'end_datetime' => date('Y-m-d H:i:s', $currenDate + 3600 * ($i + 1)),
                    ]);
                }
            }
        }

        if ($this->fetchTable('Plannings')->saveMany($newPlannings)) {
            $this->Flash->success("Le planning pour $year est généré.");
        } else {
            $this->Flash->error('Le planning n\'a pas pu être généré.');
        }

        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
    }
}
