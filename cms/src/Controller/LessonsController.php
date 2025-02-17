<?php
declare(strict_types=1);

namespace App\Controller;

use App\Handler\DatabaseHandler;
use App\Handler\ValidationHandler;

/**
 * Lessons Controller
 *
 */
class LessonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Lessons->find();
        $lessons = $this->paginate($query);

        $this->set(compact('lessons'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lesson = $this->Lessons->get($id, contain: []);
        $this->set(compact('lesson'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $newLesson = $this->Lessons->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            $newLesson->firstname = $data['firstname'];
            $newLesson->lastname = $data['lastname'];
            $newLesson->number_of_riders = $data['number_of_people'];
            $newLesson->price = $data['price'];

            $planning = $this->fetchTable('Plannings')->find('all')->where(['id' => $data['planning']])->contain('Lessons')->first();
            $newLesson->planning = $planning;

            $sumOfRiders = 0;
            foreach ($planning->lessons as $lesson) {
                $sumOfRiders += $lesson->number_of_riders;
            }

            if ($newLesson->price < 0 || $newLesson->price > 99999) {
                $this->Flash->error(__('Le prix entré est incorrect.'));    
            } else if ($newLesson->number_of_riders > 8 || $newLesson->number_of_riders < 1) {
                $this->Flash->error(__('Le nombre de personnes entré est incorrect.'));    
            } else if ($sumOfRiders + $newLesson->number_of_riders > 8) {
                $this->Flash->error(__('Il n\'y a pas assez de places pendant cette séance pour accueillir autant de personnes.'));    
            } else if ($this->Lessons->save($newLesson)) {
                $this->Flash->success(__('La leçon a bien été créée.'));
            } else {
                $this->Flash->error(__('La leçon n\'a pas pu être créée. Veuillez réessayer.'));
            }
        }
        
        $lesson = $newLesson;
        $this->set(compact('lesson'));
        
        return $this->redirect(
            [
                'controller' => 'Dashboard',
                'action' => 'index'
            ]
        );
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lesson = $this->Lessons->get($id, contain: ['Plannings', 'Plannings.Lessons']);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $newPlanning = $this->fetchTable('Plannings')->find('all')->where(['id' => $data['planning_id']])->contain('Lessons')->firstOrFail();
            $lesson = $this->Lessons->patchEntity($lesson, $data);
            $isPlanningFree = ValidationHandler::isPlanningFree($newPlanning, $lesson->id, intval($data['number_of_riders']));

            if (! $isPlanningFree) {
                $this->Flash->error(__('La séance n\'est pas disponible pour ce nombre de personnes.'));    
            } else if ($isPlanningFree && $this->Lessons->save($lesson)) {
                $this->Flash->success(__('La leçon a été modifiée.'));
                return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
            } else {
                $this->Flash->error(__('La leçon n\'a pas pu être sauvegardée.'));
            }
        }

        $monthlyPlannings = DatabaseHandler::filterMonthlyPlannings($this->fetchTable('Plannings'));
        $this->set(compact('monthlyPlannings'));
        $this->set(compact('lesson'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        // Retrieve the lesson to delete.
        $lesson = $this->fetchTable('Lessons')->find('all')->where(['Lessons.id' => $id])->contain(['Horses', 'Plannings'])->firstOrFail();

        if ($this->Lessons->delete($lesson)) {
            $this->Flash->success(__("The lesson has been deleted."));
        } else {
            $this->Flash->error(__('The lesson could not be deleted. Please, try again.'));
        }

        return $this->redirect(
            [
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
        );
    }
}
