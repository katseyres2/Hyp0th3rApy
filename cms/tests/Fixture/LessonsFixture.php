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
                'number_of_riders' => 1,
                'firstname' => 'Lorem ipsum dolor sit amet',
                'lastname' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-02-12 15:29:11',
                'modified' => '2025-02-12 15:29:11',
                'planning_id' => 1,
            ],
        ];
        parent::init();
    }
}
