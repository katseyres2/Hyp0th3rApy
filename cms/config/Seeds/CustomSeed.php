<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Customers seed.
 */
class CustomSeed extends AbstractSeed
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
        $this->seedRiders();
        // $this->seedCustomers();
        $this->seedUsers();
        $this->seedHorses();
        $this->seedTeams();
        $this->seedTeamsRiders();
        $this->seedLessons();
        $this->seedHorsesLessons();

    }

    private function seedRiders(): void
    {
        $data = [
            [
                'username' => 'thomas',
                'age' => 24,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'clara',
                'age' => 12,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'sidonie',
                'age' => 32,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('riders');
        $table->insert($data)->save();
    }

    private function seedCustomers(): void
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

    private function seedUsers(): void
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

    private function seedHorses(): void
    {
        $data = [
            [
                'name' => 'paul',
                'max_working_hours' => 10,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'jane',
                'max_working_hours' => 15,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'rose',
                'max_working_hours' => 5,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('horses');
        $table->insert($data)->save();
    }
    
    private function seedTeams(): void
    {
        $data = [
            [
                // 'customer_id' => null,
                'name' => 'RastaTroll',
                'price' => 1503,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                // 'customer_id' => null,
                'name' => 'PoneyPower',
                'price' => 1000,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('teams');
        $table->insert($data)->save();
    }

    private function seedTeamsRiders(): void
    {
        $data = [
            [
                'rider_id' => 1,
                'team_id' => 1,
            ],
            [
                'rider_id' => 2,
                'team_id' => 2,
            ],
            [
                'rider_id' => 3,
                'team_id' => 2,
            ],
        ];

        $table = $this->table('teams_riders');
        $table->insert($data)->save();
    }

    private function seedLessons(): void
    {
        $data = [
            [
                // 'price' => 200,
                'start_datetime' => date('Y-m-d H:i:s'),
                'end_datetime' => date('Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'team_id' => 1,
            ],
            [
                // 'price' => 120,
                'start_datetime' => date('Y-m-d H:i:s'),
                'end_datetime' => date('Y-m-d H:i:s'),
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                'team_id' => 2,
            ],
        ];

        $table = $this->table('lessons');
        $table->insert($data)->save();
    }

    private function seedHorsesLessons(): void
    {
        $data = [
            [
                'lesson_id' => 1,
                'horse_id' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'lesson_id' => 1,
                'horse_id' => 2,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'lesson_id' => 2,
                'horse_id' => 1,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'lesson_id' => 1,
                'horse_id' => 3,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('horses_lessons');
        $table->insert($data)->save();
    }
}
