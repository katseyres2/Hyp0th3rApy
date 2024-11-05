<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Horses seed.
 */
class HorsesSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'paul',
                'max_working_hours' => 10,
                'deleted' => false,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'jane',
                'max_working_hours' => 15,
                'deleted' => false,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'rose',
                'max_working_hours' => 5,
                'deleted' => false,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('horses');
        $table->insert($data)->save();
    }
}
