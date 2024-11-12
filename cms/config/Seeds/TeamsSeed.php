<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Teams seed.
 */
class TeamsSeed extends AbstractSeed
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
                'customer_id' => 1,
                'name' => 'RastaTroll',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'customer_id' => 2,
                'name' => 'PoneyPower',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('teams');
        $table->insert($data)->save();
    }
}
