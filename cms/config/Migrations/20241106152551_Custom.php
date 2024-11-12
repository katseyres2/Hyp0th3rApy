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
        $this->table('customers')
            ->addColumn('firstname', 'string',  ['default' => null,                 'limit' => 255,     'null' => false])
            ->addColumn('lastname', 'string',   ['default' => null,                 'limit' => 255,     'null' => false])
            ->addColumn('phone', 'string',      ['default' => null,                 'limit' => 255,     'null' => false])
            ->addColumn('email', 'string',      ['default' => null,                 'limit' => 255,     'null' => false])
            ->addColumn('created', 'datetime',  ['default' => 'CURRENT_TIMESTAMP',  'limit' => null,    'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP',  'limit' => null,    'null' => false])
            ->create();

        $this->table('horses')
            ->addColumn('name', 'string',               ['default' => null,                 'limit' => 255,     'null' => false])
            ->addColumn('max_working_hours', 'integer', ['default' => null,                 'limit' => null,    'null' => false, 'signed' => true])
            ->addColumn('created', 'datetime',          ['default' => 'CURRENT_TIMESTAMP',  'limit' => null,    'null' => false])
            ->addColumn('modified', 'datetime',         ['default' => 'CURRENT_TIMESTAMP',  'limit' => null,    'null' => false])
            ->create();

        $this->table('lessons')
            ->addColumn('price', 'float',               ['default' => null,                 'limit' => null, 'null' => false, 'signed' => true])
            ->addColumn('start_datetime', 'datetime',   ['default' => null,                 'limit' => null, 'null' => false])
            ->addColumn('end_datetime', 'datetime',   ['default' => null,                 'limit' => null, 'null' => false])
            ->addColumn('created', 'datetime',          ['default' => 'CURRENT_TIMESTAMP',  'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime',         ['default' => 'CURRENT_TIMESTAMP',  'limit' => null, 'null' => false])
            ->addColumn('customer_id', 'integer',       ['default' => null,                 'limit' => null, 'null' => false, 'signed' => true])
            ->addIndex(['customer_id'], ['name' => 'fk_customers'])
            ->addForeignKey('customer_id', 'customers', 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_customers'])
            ->create();

        $this->table('horses_lessons')
            ->addColumn('lesson_id', 'integer', ['default' => null,                 'limit' => null, 'null' => false, 'signed' => true])
            ->addColumn('horse_id', 'integer',  ['default' => null,                 'limit' => null, 'null' => false, 'signed' => true])
            ->addColumn('created', 'datetime',  ['default' => 'CURRENT_TIMESTAMP',  'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP',  'limit' => null, 'null' => false])
            ->addIndex(['horse_id'], ['name' => 'fk_horses'])
            ->addForeignKey('horse_id', 'horses', 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_horses'])
            ->addIndex(['lesson_id'], ['name' => 'fk_lessons'])
            ->addForeignKey('lesson_id', 'lessons', 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_lessons'])
            ->create();
        
        $this->table('riders')
            ->addColumn('username', 'string', ['default' => null, 'limit' => 255, 'null' => true])
            ->addColumn('age', 'integer',  ['default' => null, 'limit' => null, 'null' => true, 'signed' => true])
            ->addColumn('created', 'datetime',  ['default' => 'CURRENT_TIMESTAMP',  'limit' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP',  'limit' => null, 'null' => false])
            ->create();
        
        $this->table('teams')
            ->addColumn('name', 'string', ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('customer_id', 'integer', ['default' => null, 'limit' => null, 'null' => false, 'signed' => true])
            ->addIndex(['customer_id'], ['name' => 'fk_teams_customers'])
            ->addForeignKey('customer_id', 'customers', 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_teams_customers'])
            ->create();

        $this->table('teams_riders')
        ->addColumn('created', 'datetime',  ['default' => null, 'null' => false])
        ->addColumn('modified', 'datetime', ['default' => null, 'null' => false])
        ->addColumn('rider_id', 'integer', ['default' => null, 'limit' => null, 'null' => false, 'signed' => true])
        ->addColumn('team_id', 'integer', ['default' => null, 'limit' => null, 'null' => false, 'signed' => true])
        ->addIndex(['rider_id'], ['name' => 'fk_teams_riders_riders', 'unique' => false])
        ->addIndex(['team_id'] , ['name' => 'fk_teams_riders_teams', 'unique' => false])
        ->addForeignKey('rider_id', 'riders', 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_teams_riders_riders'])
        ->addForeignKey('team_id' , 'teams' , 'id', ['update' => 'RESTRICT', 'delete' => 'RESTRICT', 'constraint' => 'fk_teams_riders_teams' ])
        ->create();
        
        $this->table('users')
            ->addColumn('username', 'string',   ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('password', 'string',   ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('email', 'string',      ['default' => null, 'limit' => 255, 'null' => false])
            ->addColumn('created', 'datetime',  ['default' => null, 'null' => false])
            ->addColumn('modified', 'datetime', ['default' => null, 'null' => false])
            ->addIndex(['username', 'email'], ['unique' => true])
            ->create();
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

        $this->table('customers')
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
