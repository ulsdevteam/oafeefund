<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property int $request_id
 * @property \Cake\I18n\FrozenDate $publication_date
 * @property string $article_url
 * @property string $dscholarship_archive
 *
 * @property \App\Model\Entity\Request $request
 */
class Article extends Entity
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
        'request_id' => true,
        'publication_date' => true,
        'article_url' => true,
        'dscholarship_archive' => true,
        'request' => true
    ];
}
