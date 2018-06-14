<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @property \App\Model\Table\DenialReasonsTable|\Cake\ORM\Association\BelongsTo $DenialReasons
 * @property \App\Model\Table\ArticlesTable|\Cake\ORM\Association\HasMany $Articles
 * @property \App\Model\Table\TransactionsTable|\Cake\ORM\Association\HasMany $Transactions
 *
 * @method \App\Model\Entity\Request get($primaryKey, $options = [])
 * @method \App\Model\Entity\Request newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Request[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Request|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Request[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Request findOrCreate($search, callable $callback = null, $options = [])
 */
class RequestsTable extends Table
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

        $this->setTable('requests');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('DenialReasons', [
            'foreignKey' => 'denial_id'
        ]);
        $this->hasMany('Articles', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('Transactions', [
            'foreignKey' => 'request_id'
        ]);
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
            ->scalar('username')
            ->maxLength('username', 32)
            ->requirePresence('username', 'create')
            ->notEmpty('username');

        $validator
            ->scalar('author_name')
            ->maxLength('author_name', 128)
            ->requirePresence('author_name', 'create')
            ->notEmpty('author_name');

        $validator
            ->scalar('email')
            ->maxLength('email', 32)
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->scalar('school')
            ->maxLength('school', 64)
            ->requirePresence('school', 'create')
            ->notEmpty('school');

        $validator
            ->scalar('department')
            ->maxLength('department', 64)
            ->requirePresence('department', 'create')
            ->notEmpty('department');

        $validator
            ->scalar('publisher')
            ->maxLength('publisher', 64)
            ->requirePresence('publisher', 'create')
            ->notEmpty('publisher');

        $validator
            ->scalar('publication_name')
            ->maxLength('publication_name', 255)
            ->requirePresence('publication_name', 'create')
            ->notEmpty('publication_name');

        $validator
            ->numeric('amount_requested')
            ->requirePresence('amount_requested', 'create')
            ->notEmpty('amount_requested');

        $validator
            ->scalar('article_title')
            ->requirePresence('article_title', 'create')
            ->notEmpty('article_title');

        /*$validator
            ->dateTime('inquiry_date')
            ->requirePresence('inquiry_date', 'create')
            ->Empty('inquiry_date');*/

        $validator
            ->scalar('author_status')
            ->maxLength('author_status', 16)
            ->requirePresence('author_status', 'create')
            ->notEmpty('author_status');

        $validator
            ->scalar('bmc')
            ->maxLength('bmc', 16)
            ->requirePresence('bmc', 'create')
            ->notEmpty('bmc');

        $validator
            ->scalar('hs')
            ->maxLength('hs', 16)
            ->requirePresence('hs', 'create')
            ->notEmpty('hs');

        $validator
            ->scalar('funded')
            ->maxLength('funded', 16)
            ->requirePresence('funded', 'create')
            ->notEmpty('funded');
        $validator
            ->scalar('internal_note')
            ->allowEmpty('internal_note');
        $validator
            ->scalar('other_authors')
            ->allowEmpty('other_authors');
        $validator
            ->scalar('application_completed')
            ->allowEmpty('application_completed');
                

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['denial_id'], 'DenialReasons'));

        return $rules;
    }
}
