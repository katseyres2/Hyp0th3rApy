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
				$this->Flash->success(__('Ajout réussi.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('Cannot add new horse.'));
			}
		}

		$this->set('horse', $horse);
	}

	function edit()
	{
		$this->request->allowMethod('put');
		$id = $this->request->getData('id');
		$update = $this->request->getData('update');
		$horse = $this->Horses->findById($id)->firstOrFail();

		if ($update) {
			$this->Horses->patchEntity($horse, $this->request->getData());

			if ($this->Horses->save($horse)) {
				$this->Flash->success(__("Sauvegarde réussie."));
				return $this->redirect(['action' => 'index']);
			}
			
			$this->Flash->error(__("Le cheval $horse->name n'a pas été modifié;"));
		}

		$this->set('horse', $horse);
	}

	function delete()
	{
		$this->request->allowMethod(['delete']);
		$id = $this->request->getData('id');
		$horse = $this->Horses->findById($id)->firstOrFail();

		if ($this->Horses->delete($horse)) {
			$this->Flash->success(__("Suppression réussie."));
			return $this->redirect(['action' => 'index']);
		}
	}
}