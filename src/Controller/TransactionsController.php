<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Transactions Controller
 *
 * @property \App\Model\Table\TransactionsTable $Transactions
 *
 * @method \App\Model\Entity\Transaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransactionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requests']
        ];
        $transactions = $this->paginate($this->Transactions);

        $this->set(compact('transactions'));
    }

    /**
     * View method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => ['Requests']
        ]);

        $this->set('transaction', $transaction);
    }

    /**
     * Add method
     * If a new transaction is added, it will be set as paid in the Requests table.
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
        $transaction = $this->Transactions->newEntity();
        $this->set('id', $id);
        if ($this->request->is('post')) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));
                $this->loadModel('Requests');
                $approved=$this->Requests->query();
                $approved->update()
                ->set(['Funded' => 'Paid'])
                ->where(['id' => $id])
                ->execute();

                return $this->redirect(["controller" => "Requests",'action' => 'approvedrequests']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $requests = $this->Transactions->Requests->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'requests'));

        if ($id!=null) {
            $this->loadModel('Requests');
            $request = $this->Requests->get($id, [
            'contain' => ['DenialReasons', 'Articles', 'Transactions']
        ]);

            $this->set('request', $request);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transaction = $this->Transactions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));

                return $this->redirect(["controller" => "Requests",'action' => 'approvedrequests']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $requests = $this->Transactions->Requests->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'requests'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transaction = $this->Transactions->get($id);
        if ($this->Transactions->delete($transaction)) {
            $this->Flash->success(__('The transaction has been deleted.'));
        } else {
            $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    /*
     * @param string $user is passed, which can  be received from
     * $this->Auth->user() . This is the array of the current user who
     * has logged in. Depending on the permissions of that user's
     * specific role in the organization access to the page requested
     * is given.
     * @return boolean , true if access granted.
     */
    public function isAuthorized($user)
    {
        // Admin can access every action
        if (($this->request->action==="index") && isset($user['role']) && $user['role'] === 'admin') {
            return true;
        } else if (isset($user['role']) && $user['role'] === 'payment_team') {
            return true;
        }
        // Default deny
        return false;
    }

}
