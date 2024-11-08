<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class S2 extends AbstractMigration
{
    /**
     * Up Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-up-method
     * @return void
     */
    public function up(): void
    {
        $this->table('customers')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('deleted', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('horses')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('max_working_hours', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('deleted', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('horses_lessons')
            ->addColumn('lesson_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('horse_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('deleted', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'horse_id',
                ],
                [
                    'name' => 'fk_horses',
                ]
            )
            ->addIndex(
                [
                    'lesson_id',
                ],
                [
                    'name' => 'fk_lessons',
                ]
            )
            ->create();

        $this->table('lessons')
            ->addColumn('hours', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('price', 'float', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('number_of_people', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addColumn('start_datetime', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('customer_id', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
                'signed' => true,
            ])
            ->addIndex(
                [
                    'customer_id',
                ],
                [
                    'name' => 'fk_customers',
                ]
            )
            ->create();

        $this->table('horses_lessons')
            ->addForeignKey(
                'horse_id',
                'horses',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT',
                    'constraint' => 'fk_horses'
                ]
            )
            ->addForeignKey(
                'lesson_id',
                'lessons',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT',
                    'constraint' => 'fk_lessons'
                ]
            )
            ->update();

        $this->table('lessons')
            ->addForeignKey(
                'customer_id',
                'customers',
                'id',
                [
                    'update' => 'RESTRICT',
                    'delete' => 'RESTRICT',
                    'constraint' => 'fk_customers'
                ]
            )
            ->update();
    }

    /**
     * Down Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-down-method
     * @return void
     */
    public function down(): void
    {
        $this->table('horses_lessons')
            ->dropForeignKey(
                'horse_id'
            )
            ->dropForeignKey(
                'lesson_id'
            )->save();

        $this->table('lessons')
            ->dropForeignKey(
                'customer_id'
            )->save();

        $this->table('customers')->drop()->save();
        $this->table('horses')->drop()->save();
        $this->table('horses_lessons')->drop()->save();
        $this->table('lessons')->drop()->save();
    }
}
