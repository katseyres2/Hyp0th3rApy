<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HorsesFixture
 */
class HorsesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'max_working_hours' => 1,
                'created' => '2024-11-12 13:26:22',
                'modified' => '2024-11-12 13:26:22',
            ],
        ];
        parent::init();
    }
}
