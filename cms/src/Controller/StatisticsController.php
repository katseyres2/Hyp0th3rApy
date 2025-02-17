<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\Date;

/**
 * Statistics Controller
 *
 */
class StatisticsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $datetime = Date::today()->format('Y-m-d');
        $firstDay = date("Y-m-01", strtotime($datetime));
        $lastDay = date("Y-m-t", strtotime($datetime));
        $condition = "Plannings.start_datetime BETWEEN '$firstDay' AND '$lastDay'";

        $lastCreatedLesson = $this->fetchTable('Lessons')->find('all')->orderByAsc('created')->firstOrFail(); 
        $numberOfLessonsThisMonth = $this->fetchTable('Lessons')->find('all', [$condition])->contain('Plannings')->count();
        $numberOfHorses = $this->fetchTable('Horses')->find('all')->count();
        $lastCreatedHorse = $this->fetchTable('Horses')->find('all')->orderByDesc('created')->first();
        
        $lessons = $this->fetchTable('Lessons')->find('all', [$condition])->toArray();
        $monthAmount = 0;

        foreach ($lessons as $lesson) {
            $monthAmount += $lesson->price;
        }

        $data =[
            'month_amount' => $monthAmount,
            // 'last_created_lesson' => $lastCreatedLesson,
            'number_of_lessons_this_month' => $numberOfLessonsThisMonth,
            'number_of_horses' => $numberOfHorses,
            'last_created_horse' => $lastCreatedHorse,
        ];

        $this->set(compact('data'));
    }
}
