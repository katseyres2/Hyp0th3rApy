<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlanningsFixture
 */
class PlanningsFixture extends TestFixture
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
                'start_datetime' => '2025-02-12 15:29:22',
                'end_datetime' => '2025-02-12 15:29:22',
                'created' => '2025-02-12 15:29:22',
                'modified' => '2025-02-12 15:29:22',
            ],
        ];
        parent::init();
    }
}
