<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LessonsFixture
 */
class LessonsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'price' => 1,
                'start_datetime' => '2024-11-12 13:58:48',
                'end_datetime' => '2024-11-12 13:58:48',
                'created' => '2024-11-12 13:58:48',
                'modified' => '2024-11-12 13:58:48',
                'team_id' => 1,
            ],
        ];
        parent::init();
    }
}
