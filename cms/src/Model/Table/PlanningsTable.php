<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plannings Model
 *
 * @property \App\Model\Table\LessonsTable&\Cake\ORM\Association\HasMany $Lessons
 *
 * @method \App\Model\Entity\Planning newEmptyEntity()
 * @method \App\Model\Entity\Planning newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Planning> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Planning get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Planning findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Planning patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Planning> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Planning|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Planning saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Planning>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Planning>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Planning>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Planning> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Planning>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Planning>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Planning>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Planning> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PlanningsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('plannings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Lessons', [
            'foreignKey' => 'planning_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->dateTime('start_datetime')
            ->requirePresence('start_datetime', 'create')
            ->notEmptyDateTime('start_datetime');

        $validator
            ->dateTime('end_datetime')
            ->requirePresence('end_datetime', 'create')
            ->notEmptyDateTime('end_datetime');

        return $validator;
    }
}
