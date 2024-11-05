<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Event\EventInterface;
use Cake\Validation\Validator;

class HorsesTable extends Table
{
	public function beforeSave($even, $entity, $options)
	{
		$entity->modified = date('Y-m-d H:i:s');

		if ($entity->isNew() && !$entity->slug) {
			$sluggedName = Text::slug($entity->name);
			$entity->slug = substr($sluggedName, 0, 191);
		}
	}

	public function initialize(array $config): void
	{
		// $this->setTable('horses');
		// $this->setPrimaryKey('id');
		// $this->setEntityClass('App\Model\Entity\Horse');
		$this->addBehavior('Timestamp');
	}

	function validationDefault(Validator $validator): Validator
	{
		$validator
			->notEmptyString('name')
			->minLength('name', 1)
			->maxLength('name', 255)
			->notEmptyString('max_working_hours')
			->minLength('max_working_hours', 1)
			->maxLength('max_working_hours', 3);
		
		return $validator;
	}
}