<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lesson Entity
 *
 * @property int $id
 * @property int $price
 * @property int $number_of_riders
 * @property string $firstname
 * @property string $lastname
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 * @property int $planning_id
 *
 * @property \App\Model\Entity\Horse[] $horses
 * @property \App\Model\Entity\Planning[] $plannings
 */
class Lesson extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'price' => true,
        'number_of_riders' => true,
        'firstname' => true,
        'lastname' => true,
        'created' => true,
        'modified' => true,
        'planning_id' => true,
        'horses' => true,
        'plannings' => true,
    ];
}
