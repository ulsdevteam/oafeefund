<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property float $amount_paid
 * @property string $description
 * @property \Cake\I18n\FrozenDate $date_paid
 * @property int $cheque_number
 * @property int $request_id
 *
 * @property \App\Model\Entity\Request $request
 */
class Transaction extends Entity
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
        'amount_paid' => true,
        'description' => true,
        'date_paid' => true,
        'cheque_number' => true,
        'request_id' => true,
        'request' => true
    ];
}
