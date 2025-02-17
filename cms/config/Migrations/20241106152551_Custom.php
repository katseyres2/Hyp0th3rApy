<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class Custom extends AbstractMigration
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
        $this->table('horses')
            ->addColumn('name', 'string',               ['default' => null,                 'limit' => 255,     'null' => false])
            ->addColumn('max_working_hours', 'integer', ['default' => null,                 'limit' => null,    'null' => false, 'signed' => true])
            ->addColumn('created', 'datetime',          ['default' => 'CURRENT_TIMESTAMP',  'limit' => null,    'null' => false])
            ->addColumn('modified', 'datetime',         ['default' => 'CURRENT_TIMESTAMP',  'limit' => null,    'null' => false])
            ->create()
        ;

        $this->table('users')
            ->addColumn('username', 'string',   ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('password', 'string',   ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('email', 'string',      ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('created', 'datetime',  ['default' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'null' => false])
            ->addIndex(['username', 'email'], ['unique' => false])
            ->create()
        ;

        $this->table('plannings')
            ->addColumn('start_datetime', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('end_datetime', 'datetime', ['default' => null, 'limit' => null, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'limit' => null, 'null' => false])
            ->create()
        ;

        $this->table('lessons')
            ->addColumn('price', 'integer', ['default' => null, 'limit' => null, 'null' => false, 'signed' => true])
            ->addColumn('number_of_riders', 'integer', ['default' => null, 'limit' => null, 'null' => false, 'signed' => true])
            ->addColumn('firstname', 'string',   ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('lastname', 'string',   ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'limit' => null, 'null' => false])
            ->addColumn('planning_id', 'integer', ['default' => null, 'limit' => null, 'null' => false, 'signed' => true])
            ->addIndex(['planning_id'], ['name' => 'fk_lessons_plannings'])
            ->addForeignKey('planning_id', 'plannings', 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_lessons_plannings'])
            ->create()
        ;

        $this->table('horses_lessons')
            ->addColumn('lesson_id', 'integer', ['default' => null, 'limit' => null, 'null' => false, 'signed' => true])
            ->addColumn('horse_id', 'integer',  ['default' => null, 'limit' => null, 'null' => false, 'signed' => true])
            ->addColumn('created', 'datetime',  ['default' => 'CURRENT_TIMESTAMP',  'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP',  'limit' => null, 'null' => false])
            ->addIndex(['horse_id'], ['name' => 'fk_horses_lessons_horses'])
            ->addIndex(['lesson_id'], ['name' => 'fk_horses_lessons_lessons'])
            ->addForeignKey('horse_id', 'horses', 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_horses_lessons_horses'])
            ->addForeignKey('lesson_id', 'lessons', 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_horses_lessons_lessons'])
            ->create()
        ;
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
            ->dropForeignKey('horse_id')
            ->dropForeignKey('lesson_id')
            ->drop()
            ->save();

        $this->table('lessons')
            ->dropForeignKey('customer_id')
            ->drop()
            ->save();
        
        $this->table('horses')
            ->drop()
            ->save();

        $this->table('users')
            ->drop()
            ->save();
    }
}
