<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vendeur Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $nom
 * @property string $prenom
 * @property string $phone
 * @property string $email
 * @property string $slug
 * @property \Cake\I18n\FrozenDate $created
 * @property \Cake\I18n\FrozenDate $modified
 * @property int $efface
 *
 * @property \App\Model\Entity\Propriete[] $proprietes
 */
class Vendeur extends Entity {

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
        'user_id' => true,
        'nom' => true,
        'prenom' => true,
        'phone' => true,
        'email' => true,
        'slug' => true,
        'created' => true,
        'modified' => true,
        'efface' => true,
        'proprietes' => true
    ];

    //permet d'afficher le prenom puis le nom dans la vue add
    protected function _getPrenomNom() {
        return
                $this->_properties['prenom'] .
                ' ' .
                $this->_properties['nom'];
    }

}
