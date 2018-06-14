<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Budget Entity
 *
 * @property int $id
 * @property string $fiscal_year
 * @property \Cake\I18n\FrozenDate $budget_date_begin
 * @property \Cake\I18n\FrozenDate $budget_date_end
 * @property float $total_budget
 * @property float $budget_per_person
 */
class Budget extends Entity
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
        'fiscal_year' => true,
        'budget_date_begin' => true,
        'budget_date_end' => true,
        'total_budget' => true,
        'budget_per_person' => true
    ];
}
