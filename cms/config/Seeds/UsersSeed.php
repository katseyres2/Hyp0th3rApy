<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'username' => 'max',
                'password' => '$2y$10$4e.sL0Xjz1JUph/n.I/3RuZn76s8zLEJtEfwqb2aJn2g1QA5dKLdi',
                'email' => 'max@mail.com',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ]
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
