<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Propriete Entity
 *
 * @property int $id
 * @property int $vendeur_id
 * @property string $adresse
 * @property string $prix
 * @property string $description
 * @property string $image
 * @property \Cake\I18n\FrozenDate $created
 * @property \Cake\I18n\FrozenDate $modified
 * @property int $efface
 *
 * @property \App\Model\Entity\Vendeur $vendeur
 */
class Propriete extends Entity
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
        'vendeur_id' => true,
        'adresse' => true,
        'prix' => true,
        'description' => true,
        'image' => true,
        'created' => true,
        'modified' => true,
        'efface' => true,
        'vendeur' => true,
        'tags' => true,
        'files' => true
    ];
}
