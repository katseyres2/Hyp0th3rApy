<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Lessons seed.
 */
class LessonsSeed extends AbstractSeed
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
                'price' => 200,
                'start_datetime' => date('Y-m-d H:i:s'),
                'end_datetime' => date('Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'customer_id' => 1,
            ],
            [
                'price' => 120,
                'start_datetime' => date('Y-m-d H:i:s'),
                'end_datetime' => date('Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'customer_id' => 2,
            ],
        ];

        $table = $this->table('lessons');
        $table->insert($data)->save();
    }
}
