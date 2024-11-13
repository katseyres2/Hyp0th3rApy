<?php
namespace App\Controller;

use Cake\I18n\Date;
use DateInterval;
use DateTime;

class DashboardController extends AppController
{
	public function index()
	{
		$cTable = $this->fetchTable('Customers');
		$customers = $cTable->find('all')->contain([]);
		$this->set(compact('customers'));
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

		$today = Date::today();
		$tomorrow = $today->add(DateInterval::createFromDateString('1 day'));
		$today = $today->format('Y-m-d 00:00:00');
		$tomorrow = $tomorrow->format('Y-m-d 00:00:00');

		$conditions = ["Lessons.start_datetime BETWEEN '$today' AND '$tomorrow'"];
		$lessons = $table->find('all', ['conditions' => $conditions])->contain(['Teams', 'Horses', 'Teams.Riders', 'Teams.Customers'])->orderByAsc('start_datetime');

		$horses = $this->fetchTable('Horses')->find('all')->contain([]);
		$selectedLesson = $this->request->getSession()->read('lesson.selected');

		if ($selectedLesson == null) {
			$selectedLesson = $lessons->first()->id;
		}

		$this->set(compact('lessons'));
		$this->set(compact('horses'));
		$this->set(compact('selectedLesson'));
	}
}