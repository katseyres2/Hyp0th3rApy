<?php
namespace App\Controller;

use Cake\I18n\Date;
use DateInterval;
use DateTime;

class DashboardController extends AppController
{
	public function index()
	{
		$table = $this->fetchTable('Lessons');

		$today = Date::today();
		$tomorrow = $today->add(DateInterval::createFromDateString('1 day'));
		$today = $today->format('Y-m-d 00:00:00');
		$tomorrow = $tomorrow->format('Y-m-d 00:00:00');

		$conditions = ["Lessons.start_datetime BETWEEN '$today' AND '$tomorrow'"];
		$lessons = $table->find('all', ['conditions' => $conditions])->contain(['Teams', 'Horses', 'Teams.Riders'])->orderByAsc('start_datetime');

		$horses = $this->fetchTable('Horses')->find('all')->contain([])->orderByAsc('name');
		$selectedLesson = $this->request->getSession()->read('lesson.selected');

		if ($selectedLesson == null && count($lessons->toArray()) > 0) {
			$selectedLesson = $lessons->first()->id;
		}

		$this->set(compact('lessons'));
		$this->set(compact('horses'));
		$this->set(compact('selectedLesson'));
	}
}