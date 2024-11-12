<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Horses Model
 *
 * @method \App\Model\Entity\Horse newEmptyEntity()
 * @method \App\Model\Entity\Horse newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Horse> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Horse get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Horse findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Horse patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Horse> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Horse|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Horse saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Horse>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Horse>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Horse>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Horse> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Horse>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Horse>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Horse>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Horse> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HorsesTable extends Table
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

        $this->setTable('horses');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Lessons', [
            'foreignKey' => 'horse_id',
            'targetForeignKey' => 'lesson_id',
            'joinTable' => 'horses_lessons',
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->integer('max_working_hours')
            ->requirePresence('max_working_hours', 'create')
            ->notEmptyString('max_working_hours');

        return $validator;
    }
}
