<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Horse extends Entity
{
	protected array $_accessible = [
		'*' => true,
		'id' => false,
		'slug' => false,
	];
}