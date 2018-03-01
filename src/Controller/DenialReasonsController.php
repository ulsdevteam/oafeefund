<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * DenialReasons Controller
 *
 * @property \App\Model\Table\DenialReasonsTable $DenialReasons
 *
 * @method \App\Model\Entity\DenialReason[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DenialReasonsController extends AppController
{
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $denialReasons = $this->paginate($this->DenialReasons);

        $this->set(compact('denialReasons'));
    }

    /**
     * View method
     *
     * @param string|null $id Denial Reason id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $denialReason = $this->DenialReasons->get($id, [
            'contain' => []
        ]);

        $this->set('denialReason', $denialReason);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $denialReason = $this->DenialReasons->newEntity();
        if ($this->request->is('post')) 
            {
            $denialReason = $this->DenialReasons->patchEntity($denialReason, $this->request->getData());
            if ($this->DenialReasons->save($denialReason)) {
                $this->Flash->success(__('The denial reason has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The denial reason could not be saved. Please, try again.'));
        }
        $this->set(compact('denialReason'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Denial Reason id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $denialReason = $this->DenialReasons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $denialReason = $this->DenialReasons->patchEntity($denialReason, $this->request->getData());
            if ($this->DenialReasons->save($denialReason)) {
                $this->Flash->success(__('The denial reason has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The denial reason could not be saved. Please, try again.'));
        }
        $this->set(compact('denialReason'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Denial Reason id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $denialReason = $this->DenialReasons->get($id);
        if ($this->DenialReasons->delete($denialReason)) {
            $this->Flash->success(__('The denial reason has been deleted.'));
        } else {
            $this->Flash->error(__('The denial reason could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user)
{ 
        //$this->Flash->success(__($this->request->action));
    // deny index action for certain role
        if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }
}
}
