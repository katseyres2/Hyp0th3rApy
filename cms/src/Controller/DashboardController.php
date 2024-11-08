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

		$lTable = $this->fetchTable('Lessons');
		$lessons = $this->paginate($lTable->find());

		foreach ($lessons as $lesson) {
			$lesson->customer = $cTable->findById($lesson->customer_id)->firstOrFail();
		}

		$this->set(compact('lessons'));
	}
}