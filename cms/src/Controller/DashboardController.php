<?php
namespace App\Controller;

class DashboardController extends AppController
{
	public function index()
	{
		$cTable = $this->fetchTable('Customers');
		$customer = $cTable->newEmptyEntity();
		
		if ($this->request->is('post')) {
			$customer = $cTable->patchEntity($customer, $this->request->getData());
			$customer->deleted = false;

            if ($cTable->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }

		$this->set(compact('customer'));
		$table = $this->fetchTable('Lessons');
		$lessons = $table->find('all')->contain(['Teams', 'Horses', 'Teams.Riders', 'Teams.Customers']);
		$lessons = $this->paginate($lessons);
		$this->set(compact('lessons'));
	}
}