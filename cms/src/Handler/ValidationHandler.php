<?php
namespace App\Handler;

use App\Model\Entity\Planning;

class ValidationHandler
{
    /**
     * Check if this planning is free for this number of people.
     */
    public static function isPlanningFree(Planning $planning, int $lessonId, int $numberOfRiders): bool
    {
        $sumOfRiders = 0;
        
        foreach ($planning->lessons as $lesson) {
            if ($lesson->id == $lessonId) {
                continue;
            }
            
            $sumOfRiders += $lesson->number_of_riders;
        }

        return $sumOfRiders + $numberOfRiders < 9;
    }
}