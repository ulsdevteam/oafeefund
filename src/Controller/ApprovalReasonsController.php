<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApprovalReasons Controller
 *
 * @property \App\Model\Table\ApprovalReasonsTable $ApprovalReasons
 *
 * @method \App\Model\Entity\ApprovalReason[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApprovalReasonsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $approvalReasons = $this->paginate($this->ApprovalReasons);

        $this->set(compact('approvalReasons'));
    }

    /**
     * View method
     *
     * @param string|null $id Approval Reason id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $approvalReason = $this->ApprovalReasons->get($id, [
            'contain' => []
        ]);

        $this->set('approvalReason', $approvalReason);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $approvalReason = $this->ApprovalReasons->newEntity();
        if ($this->request->is('post')) {
            $approvalReason = $this->ApprovalReasons->patchEntity($approvalReason, $this->request->getData());
            if ($this->ApprovalReasons->save($approvalReason)) {
                $this->Flash->success(__('The approval reason has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The approval reason could not be saved. Please, try again.'));
        }
        $this->set(compact('approvalReason'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Approval Reason id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $approvalReason = $this->ApprovalReasons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $approvalReason = $this->ApprovalReasons->patchEntity($approvalReason, $this->request->getData());
            if ($this->ApprovalReasons->save($approvalReason)) {
                $this->Flash->success(__('The approval reason has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The approval reason could not be saved. Please, try again.'));
        }
        $this->set(compact('approvalReason'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Approval Reason id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $approvalReason = $this->ApprovalReasons->get($id);
        if ($this->ApprovalReasons->delete($approvalReason)) {
            $this->Flash->success(__('The approval reason has been deleted.'));
        } else {
            $this->Flash->error(__('The approval reason could not be deleted. Please, try again.'));
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
    public function isAuthorized($user){ 
        if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
        }
    }
    
}
