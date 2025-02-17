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
        $this->seedUsers();
        // $this->seedPlannings();
        $this->seedHorses();
        // $this->seedLessons();
        // $this->seedHorsesLessons();
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
        $info = [
            'alex' => 8,
            'bella' => 12,
            'charlie' => 3,
            'diana' => 16,
            'ethan' => 7,
            'fiona' => 10,
            'george' => 20,
            'hannah' => 15,
            'ian' => 4,
            'julia' => 19,
            'kyle' => 11,
            'lara' => 9,
            'mike' => 6,
            'nina' => 14,
            'oliver' => 0,
            'paula' => 13,
            'quentin' => 17,
            'rachel' => 22,
            'steve' => 5,
            'tina' => 24,
        ];

        $data = [];

        foreach ($info as $name => $working) {
            $data[] = [
                'name' => $name,
                'max_working_hours' => $working,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ];
        }

        $table = $this->table('horses');
        $table->insert($data)->save();
    }

    private function seedPlannings(): void
    {
        $data = [];

        for ($i=0; $i < 6; $i++) {
            $data[] = [
                'start_datetime' => date('Y-m-d H', strtotime("$i hour")),
                'end_datetime' => date('Y-m-d H', strtotime("$i hour") + 3600),
            ];
        }

        $table = $this->table('plannings');
        $table->insert($data)->save();
    }

    private function seedLessons(): void
    {
        $data = [
            [
                'price' => 200,
                'number_of_riders' => 4,
                'firstname' => 'john',
                'lastname' => 'doe',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                // 'planning_id' => 1,
            ],
            [
                'price' => 120,
                'number_of_riders' => 2,
                'firstname' => 'jane',
                'lastname' => 'doe',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
                // 'planning_id' => 2
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
