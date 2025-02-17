<?php
namespace App\Handler;

use Cake\I18n\Date;
use Cake\ORM\Table;
use DateInterval;

class DatabaseHandler
{
    /**
     * Retrieve all daily plannings.
     * @return array<Planning>
     */
    public static function filterDailyPlannings(Table $planningsTable): array
    {
        $firstDay = Date::today();
		$oneDayLater = $firstDay->add(DateInterval::createFromDateString('1 day'));
        $firstDayStringified = $firstDay->format('Y-m-d 00:00:00');
        $oneDayLaterStringified = $oneDayLater->format('Y-m-d 00:00:00');
        $dailyConditions = ["start_datetime BETWEEN '$firstDayStringified' AND '$oneDayLaterStringified'"];
        $dailyPlannings = $planningsTable->find('all', ['conditions' => $dailyConditions])->contain(['Lessons', 'Lessons.Horses'])->orderByAsc('start_datetime')->toArray();
        return $dailyPlannings;
    }

    /**
     * Retrieve all plannings from today up to one month later.
     */
    public static function filterMonthlyPlannings(Table $planningsTable): array
    {
        $firstDay = Date::today();
        $oneMonthLater = $firstDay->add(DateInterval::createFromDateString('1 month'));
        $firstDayStringified = $firstDay->format('Y-m-d 00:00:00');
        $oneMonthLaterStringified = $oneMonthLater->format('Y-m-d 00:00:00');
        $monthlyConditions = ["start_datetime BETWEEN '$firstDayStringified' AND '$oneMonthLaterStringified'"];
        $monthlyPlannings = $planningsTable->find('all', ['conditions' => $monthlyConditions])->contain(['Lessons', 'Lessons.Horses'])->orderByAsc('start_datetime')->toArray();
        return $monthlyPlannings;
    }
}