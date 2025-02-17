<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\Date;
use DateInterval;

/**
 * Invoice Controller
 *
 */
class InvoiceController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $currentDate = Date::today();
        $futureDate = $currentDate->add(DateInterval::createFromDateString('1 year'));
        $currentYear = $currentDate->format('Y-01-01 00:00:00');
        $nextYear = $futureDate->format('Y-01-01 00:00:00');

        $conditions = ["Plannings.start_datetime BETWEEN '$currentYear' AND '$nextYear'"];
        $lessons = $this->fetchTable('Lessons')->find('all', ['conditions' => $conditions])->contain('Plannings');
        $invoice = [];

        foreach ($lessons as $lesson) {
            if (!isset($invoice['year'])) {
                $invoice['year'] = $lesson->planning->start_datetime->year;
            }

            $month = $lesson->planning->start_datetime->month;

            $invoice['months'][$month]['lessons'][$lesson->id]['id'] = $lesson->id;
            $invoice['months'][$month]['lessons'][$lesson->id]['firstname'] = $lesson->firstname;
            $invoice['months'][$month]['lessons'][$lesson->id]['lastname'] = $lesson->lastname;
            
            if (!isset($invoice['months'][$month]['lessons'][$lesson->id]['total_amount'])) {
                $invoice['months'][$month]['lessons'][$lesson->id]['total_amount'] = $lesson->price;
            } else {
                $invoice['months'][$month]['lessons'][$lesson->id]['total_amount'] += $lesson->price;
            }

            if (isset($invoice['months'][$month]['total_amount'])) {
                $invoice['months'][$month]['total_amount'] += $lesson->price;
            } else {
                $invoice['months'][$month]['total_amount'] = $lesson->price;
            }

            $invoice['months'][$month]['is_current_month'] = $month == Date::today()->month;
        }

        $this->set(compact('invoice'));
    }
}
