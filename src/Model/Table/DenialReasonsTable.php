<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DenialReasons Model
 *
 * @method \App\Model\Entity\DenialReason get($primaryKey, $options = [])
 * @method \App\Model\Entity\DenialReason newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DenialReason[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DenialReason|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DenialReason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DenialReason[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DenialReason findOrCreate($search, callable $callback = null, $options = [])
 */

class DenialReasonsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('denial_reasons');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('denial_reason')
            ->maxLength('denial_reason', 512)
            ->requirePresence('denial_reason', 'create');

        $validator
            ->scalar('denial_email')
            ->requirePresence('denial_email', 'create')
            ->allowEmpty('denial_email');

        return $validator;
    }
}
