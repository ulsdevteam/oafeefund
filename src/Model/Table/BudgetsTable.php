<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Budgets Model
 *
 * @method \App\Model\Entity\Budget get($primaryKey, $options = [])
 * @method \App\Model\Entity\Budget newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Budget[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Budget|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Budget patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Budget[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Budget findOrCreate($search, callable $callback = null, $options = [])
 */
class BudgetsTable extends Table
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

        $this->setTable('budgets');
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
            ->scalar('fiscal_year')
            ->maxLength('fiscal_year', 32)
            ->requirePresence('fiscal_year', 'create')
            ->notEmpty('fiscal_year');

        $validator
            ->date('budget_date_begin')
            ->requirePresence('budget_date_begin', 'create')
            ->notEmpty('budget_date_begin');

        $validator
            ->date('budget_date_end')
            ->requirePresence('budget_date_end', 'create')
            ->notEmpty('budget_date_end');

        $validator
            ->numeric('total_budget')
            ->requirePresence('total_budget', 'create')
            ->notEmpty('total_budget');

        $validator
            ->numeric('budget_per_person')
            ->requirePresence('budget_per_person', 'create')
            ->notEmpty('budget_per_person');

        return $validator;
    }
}
