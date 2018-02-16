<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;


/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 *
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequestsController extends AppController
{
    
    
     public function adduser()
    {
         /* Now here you can put your default values */
	
        $this->viewBuilder()->layout('default2');
        $request = $this->Requests->newEntity();
        
	
	
            
        if ($this->request->is('post')) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

               return $this->redirect(['action' => 'saved']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }
        $denialReasons = $this->Requests->DenialReasons->find('list', ['limit' => 200]);
        $this->set(compact('request', 'denialReasons'));
    }
     public function saved()
    {
       $this->viewBuilder()->layout('default2');
       
     }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->Flash->success(__($this->request->action));   
        $this->viewBuilder()->layout('default');
        $this->paginate = [
            'contain' => ['DenialReasons']
        ];
        $requests = $this->paginate($this->Requests);

        $this->set(compact('requests'));
    }

    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function export($limit =3){
        $requests=$this->Requests->find('all', array('conditions' => array('Requests.id' => 4)))->contain(['DenialReasons']);
        $this->set('requests',$requests); // Name of variable being set in the view layer, set the variable request.
    }
    
    public function view($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => ['DenialReasons', 'Articles', 'Transactions']
        ]);

        $this->set('request', $request);
    }
    
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $request = $this->Requests->newEntity();
        if ($this->request->is('post')) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }
        $denialReasons = $this->Requests->DenialReasons->find('list', ['limit' => 200]);
        $this->set(compact('request', 'denialReasons'));
    }
   
    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }
        $denialReasons = $this->Requests->DenialReasons->find('list', ['limit' => 200]);
        $this->set(compact('request', 'denialReasons'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function approve($id = null){
        
         //or you can load it in beforeFilter()
        if($this->request->data != null)
        {
        $approved=$this->Requests->query();
        $approved->update()
        ->set(['Funded' => 'Approved'])
        ->where(['id' => $id])
        ->execute();
        $data = $this->request->data;
        $test = $data["reply_to"];
        $subject = $data["subject"];
        $body= $data["body"];
        $from_addr=$data["from_addr"];
        $from_name=$data["from_name"];
        $email = new Email('local');
        $email->from("$from_addr","$from_name")
        ->to("$test")
        ->subject("$subject")
        ->send("$body");
        }
        
 
    }
    public function isAuthorized($user)
{ 
        //$this->Flash->success(__($this->request->action));
    // deny index action for certain role
        if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }
    if (($this->request->action==="index") && $user['role'] === 'payment_team') {
        
        return true;
    }
    
    
    
}
}
