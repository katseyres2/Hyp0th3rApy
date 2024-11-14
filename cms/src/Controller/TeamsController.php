<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\DateTime;

/**
 * Teams Controller
 *
 * @property \App\Model\Table\TeamsTable $Teams
 */
class TeamsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Teams->find()->contain(['Customers']);
        $teams = $this->paginate($query);

        $this->set(compact('teams'));
    }

    /**
     * View method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $team = $this->Teams->get($id, contain: ['Customers', 'Riders', 'Lessons']);
        $this->set(compact('team'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod('post');
        
        $data = $this->request->getData();
        $team = $this->Teams->newEmptyEntity();

        $lessonTable = $this->fetchTable('Lessons');
        $riderTable = $this->fetchTable('Riders');
        $lesson = $lessonTable->newEmptyEntity();

        $team->name = $data['Name'];
        $team->created = new DateTime();
        $team->modified = new DateTime();
        $team->price = $data['Price'];
        $team->riders = [];
        
        $format = 'Y-m-d H:i:s';
        $start = $data['Day'] . ' ' . $data['Start'];
        $end = $data['Day'] . ' ' . $data['End'];
        
        $lesson->start_datetime = DateTime::createFromFormat($format, $start);
        $lesson->end_datetime = DateTime::createFromFormat($format, $end);
        $lesson->team = $team;

        $riders = [];

        for ($i = 0; $i < $data['People']; $i++) {
            $rider = $riderTable->newEmptyEntity();
            $rider->created = new DateTime();
            $rider->modified = new DateTime();
            $rider->username = "player $i";
            $riders[] = $rider;
        }
        
        $team->riders = $riders;
        $this->Teams->saveOrFail($team);
        $lessonTable->saveOrFail($lesson);

        $this->Flash->success(__('The team has been saved.'));
        return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $team = $this->Teams->get($id, contain: ['Riders']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $team = $this->Teams->patchEntity($team, $this->request->getData());
            if ($this->Teams->save($team)) {
                $this->Flash->success(__('The team has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The team could not be saved. Please, try again.'));
        }
        $customers = $this->Teams->Customers->find('list', limit: 200)->all();
        $riders = $this->Teams->Riders->find('list', limit: 200)->all();
        $this->set(compact('team', 'customers', 'riders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Team id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $team = $this->Teams->get($id);
        if ($this->Teams->delete($team)) {
            $this->Flash->success(__('The team has been deleted.'));
        } else {
            $this->Flash->error(__('The team could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
