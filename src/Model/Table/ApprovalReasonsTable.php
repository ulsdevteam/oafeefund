<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ApprovalReasons Model
 *
 * @method \App\Model\Entity\ApprovalReason get($primaryKey, $options = [])
 * @method \App\Model\Entity\ApprovalReason newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ApprovalReason[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ApprovalReason|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ApprovalReason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ApprovalReason[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ApprovalReason findOrCreate($search, callable $callback = null, $options = [])
 */
class ApprovalReasonsTable extends Table
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

        $this->setTable('approval_reasons');
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
            ->scalar('approval_email')
            ->requirePresence('approval_email', 'create')
            ->allowEmpty('approval_email');

        $validator
            ->scalar('approval_reason')
            ->maxLength('approval_reason', 512)
            ->requirePresence('approval_reason', 'create')
            ->notEmpty('approval_reason');

        return $validator;
    }
}
