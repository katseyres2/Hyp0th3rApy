<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Riders Model
 *
 * @property \App\Model\Table\TeamsTable&\Cake\ORM\Association\BelongsToMany $Teams
 *
 * @method \App\Model\Entity\Rider newEmptyEntity()
 * @method \App\Model\Entity\Rider newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Rider> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rider get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Rider findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Rider patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Rider> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rider|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Rider saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Rider>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Rider>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Rider>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Rider> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Rider>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Rider>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Rider>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Rider> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RidersTable extends Table
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

        $this->setTable('riders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Teams', [
            'foreignKey' => 'rider_id',
            'targetForeignKey' => 'team_id',
            'joinTable' => 'teams_riders',
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
            ->scalar('username')
            ->maxLength('username', 255)
            ->allowEmptyString('username');

        $validator
            ->integer('age')
            ->allowEmptyString('age');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);

        return $rules;
    }
}
