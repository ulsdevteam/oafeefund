<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity
 *
 * @property int $id
 * @property string $username
 * @property string $school
 * @property string $department
 * @property string $publisher
 * @property string $publication_name
 * @property float $amount_requested
 * @property string $article_title
 * @property \Cake\I18n\FrozenTime $inquiry_date
 * @property string $author_status
 * @property string $bmc
 * @property string $hs
 * @property string $funded
 * @property int $denial_id
 *
 * @property \App\Model\Entity\DenialReason $denial_reason
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Transaction[] $transactions
 */
class Request extends Entity
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
        'username' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'school' => true,
        'department' => true,
        'publisher' => true,
        'publication_name' => true,
        'amount_requested' => true,
        'article_title' => true,
        'inquiry_date' => true,
        'author_status' => true,
        'bmc' => true,
        'hs' => true,
        'funded' => true,
        'denial_id' => true,
        'denial_reason' => true,
        'articles' => true,
        'transactions' => true,
        'internal_note' => true
    ];
}
