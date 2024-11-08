<?php
namespace App\Controller;

use Authentication\AuthenticationService;

class HorsesController extends AppController
{
	function index()
	{
		$horses = $this->paginate($this->Horses->find());
		$service = new AuthenticationService();
		$identifier = $service->loadIdentifier('Authentication.Password');
		$this->set(compact('horses'));
	}

    function view($id)
    {
        $horse = $this->Horses->findById($id)->firstOrFail();
        $this->set(compact('horse'));
    }

	function add()
	{
		$horse = $this->Horses->newEmptyEntity();

		if ($this->request->is('post')) {
			$data = $this->request->getData();
			// debug($data);
			$horse = $this->Horses->patchEntity($horse, $data);
			$horse->deleted = false;

			if ($this->Horses->save($horse)) {
				$this->Flash->success(__('New horse saved.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Cannot add new horse.'));
			}
		}

		$this->set('horse', $horse);
	}

	function edit($id)
	{
		$horse = $this->Horses->findById($id)->firstOrFail();

		if ($this->request->is(['post', 'put'])) {
			$this->Horses->patchEntity($horse, $this->request->getData());

			if ($this->Horses->save($horse)) {
				$this->Flash->success(__('Horse updated.'));
				return $this->redirect(['action' => 'index']);
			}
			
			$this->Flash->error(__('Horse not updated.'));
		}

		$this->set('horse', $horse);
	}

	function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);
		$horse = $this->Horses->findById($id)->firstOrFail();

		if ($this->Horses->delete($horse)) {
			$this->Flash->success(__('Horse deleted.'));
			return $this->redirect(['action' => 'index']);
		}
	}
}