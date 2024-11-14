<?php
declare(strict_types=1);

namespace App\Controller;

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
        $lesson = $this->Lessons->newEmptyEntity();
        if ($this->request->is('post')) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success(__('The lesson has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
        }
        $this->set(compact('lesson'));
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
        $lesson = $this->Lessons->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success(__('The lesson has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
        }
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
        $this->request->allowMethod(['post', 'delete']);
        $lesson = $this->Lessons->get($id);
        if ($this->Lessons->delete($lesson)) {
            $this->Flash->success(__('The lesson has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function assign($id = null)
    {
        $this->request->allowMethod(['put']);
        $horses = $this->fetchTable('Horses')->find();
        $data = $this->request->getData();
        $lesson = $this->Lessons->findById($id)->contain(['Horses', 'Teams.Riders'])->first();

        $session = $this->request->getSession();
        $session->write('lesson.selected', $id);

        $selectedHorseIds = [];
        $lesson->horses = [];

        
        foreach (array_keys($data) as $key) {
            if (str_starts_with($key, 'horse') && $data[$key] != '-1') {
                $selectedHorseIds[] = $data[$key];
            }
        }


        foreach ($horses as $horse) {
            if (in_array($horse->id, $selectedHorseIds)) {
                $lesson->horses[] = $horse;
            }
        }

        if ($this->Lessons->save($lesson)) {
            $this->Flash->success($lesson->team->name . ' ' . date_format($lesson->start_datetime, 'H:i') . ' - ' . date_format($lesson->end_datetime, 'H:i') . ' : ' . __('The lesson has been saved.'));
        }

        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
    }
}
