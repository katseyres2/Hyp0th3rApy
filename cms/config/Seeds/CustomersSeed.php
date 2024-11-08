<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Customers seed.
 */
class CustomersSeed extends AbstractSeed
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
                'firstname' => 'john',
                'lastname' => 'doe',
                'phone' => '000112233',
                'email' => 'john@mail.com',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'firstname' => 'jane',
                'lastname' => 'doe',
                'phone' => '000112233',
                'email' => 'jane@mail.com',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('customers');
        $table->insert($data)->save();
    }
}
