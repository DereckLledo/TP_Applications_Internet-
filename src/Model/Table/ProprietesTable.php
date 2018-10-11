<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Proprietes Model
 *
 * @property \App\Model\Table\VendeursTable|\Cake\ORM\Association\BelongsTo $Vendeurs
 *
 * @method \App\Model\Entity\Propriete get($primaryKey, $options = [])
 * @method \App\Model\Entity\Propriete newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Propriete[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Propriete|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Propriete|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Propriete patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Propriete[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Propriete findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProprietesTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config) {
        parent::initialize($config);

        $this->setTable('proprietes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');



        $this->belongsTo('Vendeurs', [
            'foreignKey' => 'vendeur_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsToMany('Tags', [
            'foreignKey' => 'propriete_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'proprietes_tags'
        ]);

        $this->belongsToMany('Files', [
            'foreignKey' => 'propriete_id',
            'targetForeignKey' => 'file_id',
            'joinTable' => 'proprietes_files'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator) {
        $validator
                ->integer('id')
                ->allowEmpty('id', 'create');

        $validator
                ->scalar('adresse')
                ->maxLength('adresse', 255)
                ->requirePresence('adresse', 'create')
                ->notEmpty('adresse');

        $validator
                ->scalar('prix')
                ->maxLength('prix', 255)
                ->requirePresence('prix', 'create')
                ->notEmpty('prix');

        $validator
                ->scalar('description')
                ->requirePresence('description', 'create')
                ->notEmpty('description');

        $validator
                ->scalar('image')
                ->maxLength('image', 255);

//        $validator
//                ->requirePresence('efface', 'create')
//                ->notEmpty('efface');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        $rules->add($rules->existsIn(['vendeur_id'], 'Vendeurs'));

        return $rules;
    }

    // The $query argument is a query builder instance.
// The $options array will contain the 'tags' option we passed
// to find('tagged') in our controller action.
    public function findTagged(Query $query, array $options) {
        $columns = [
            'Proprietes.id', 'Proprietes.vendeur_id', 'Proprietes.adresse',
            'Proprietes.prix', 'Proprietes.description', 'Proprietes.image',
            'Proprietes.created',
        ];

        $query = $query
                ->select($columns)
                ->distinct($columns);

        if (empty($options['tags'])) {
            // If there are no tags provided, find proprietes that have no tags.
            $query->leftJoinWith('Tags')
                    ->where(['Tags.title IS' => null]);
        } else {
            // Find proprietes that have one or more of the provided tags.
            $query->innerJoinWith('Tags')
                    ->where(['Tags.title IN' => $options['tags']]);
        }

        return $query->group(['Proprietes.id']);
    }

}
