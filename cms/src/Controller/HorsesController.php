<?php
namespace App\Controller;

class HorsesController extends AppController
{
	public function index()
	{
		$horses = $this->Horses->find();
		$this->set(compact('horses'));
		
		$horse = $this->Horses->newEmptyEntity();
		$this->set(compact('horse'));
	}

	function add()
	{
		$this->request->allowMethod('post');
		$horse = $this->Horses->newEmptyEntity();

		if ($this->request->is('post')) {
			$data = $this->request->getData();
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

	function delete()
	{
		$this->request->allowMethod(['delete']);
		$id = $this->request->getData('id');
		$horse = $this->Horses->findById($id)->firstOrFail();

		if ($this->Horses->delete($horse)) {
			$this->Flash->success(__('Horse deleted.'));
			return $this->redirect(['action' => 'index']);
		}
	}
}