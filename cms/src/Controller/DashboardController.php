<?php
namespace App\Controller;

use App\Handler\DatabaseHandler;
use Cake\I18n\Date;
use DateInterval;
use DateTime;

class DashboardController extends AppController
{
	public function index()
	{
		$horses = $this->fetchTable('Horses')->find('all')->contain(['Lessons', 'Lessons.Plannings'])->orderByAsc('name')->toArray();
		$dailyPlannings = DatabaseHandler::filterDailyPlannings($this->fetchTable('Plannings'));
		$monthlyPlannings = DatabaseHandler::filterMonthlyPlannings($this->fetchTable('Plannings'));
		$selectedPlanning = $this->request->getSession()->read('lesson.selected');
		
		if ($selectedPlanning == null && count($dailyPlannings) > 0) {
			$selectedPlanning = $dailyPlannings[0]->id;
		}

		$this->set(compact('dailyPlannings'));
		$this->set(compact('monthlyPlannings'));
		$this->set(compact('horses'));
		$this->set(compact('selectedPlanning'));
	}
}