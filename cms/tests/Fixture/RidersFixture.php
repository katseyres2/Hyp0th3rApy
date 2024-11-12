<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RidersFixture
 */
class RidersFixture extends TestFixture
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
                'username' => 'Lorem ipsum dolor sit amet',
                'age' => 1,
                'created' => '2024-11-12 13:26:31',
                'modified' => '2024-11-12 13:26:31',
            ],
        ];
        parent::init();
    }
}
