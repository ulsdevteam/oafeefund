<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DenialReason Entity
 *
 * @property int $id
 * @property string $denial_reason
 * @property string $denial_email
 */
class DenialReason extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'denial_reason' => true,
        'denial_email' => true
    ];
}
