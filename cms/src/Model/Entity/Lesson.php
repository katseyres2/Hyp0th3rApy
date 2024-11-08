<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Lesson extends Entity
{
    protected array $_accessible = [
        '*' => true,
    ];
}