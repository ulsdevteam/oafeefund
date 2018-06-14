<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;
use App\View\Helper\LdapHelper;

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 *
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequestsController extends AppController
{
    
   // public $helpers = array('TinyMCE.TinyMCE');
    
  

    public function adduser()
    {
         /* Now here you can put your default values */
	
        $this->viewBuilder()->layout('default2');
        $request = $this->Requests->newEntity();
        //$var= LdapHelper::getInfo('HOK14');
        //$this->set('var', $var);
         //$var=$this->LdapHelper->getInfo('HOK14');
	//import('Helper', 'LdapHelper');
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
       // $this->Flash->success(__($this->request->action));   
        $this->viewBuilder()->layout('default');
        $this->paginate = [
            'contain' => ['DenialReasons']
        ];
        $requests = $this->paginate($this->Requests);
        $this->set(compact('requests'));
        $role=$this->Auth->user();
        $this->set('role',$role);
        
        
        
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
        
        $connection = ConnectionManager::get('default');
        $this->set('request', $request);
        $other_requests= $connection->execute('SELECT Requests . * FROM requests Requests WHERE Requests.username IN ( SELECT Requests.username AS inquiry_date FROM requests Requests WHERE Requests.id = :id) AND Requests.username!="" AND Requests.id!= :id',['id'=>$id])->fetchAll('assoc');
        $this->set('other_requests',$other_requests);
        $this->set('request', $request);
        $request2= $this->Requests->find('all')
                ->where(['id'=>$id]);
           $request2= $request2->first();   
            $this->loadModel('budgets');
           $name=$request2->username;
//$request3=$request3->find('all')
          //      ->where(['username'=>$requests2]);
       $date= date('m');
       $results3 = $connection->execute('SELECT Requests.inquiry_date AS inquiry_date FROM requests Requests WHERE Requests.id= :id',['id'=>$id])->fetchAll('assoc');
       $date= $results3[0][inquiry_date]; 
       $results2 = $connection->execute('SELECT ROUND(SUM(Requests.amount_requested),2) As total_amount FROM requests Requests, budgets Budgets WHERE Budgets.budget_date_begin<=:date AND Budgets.budget_date_end>=:date AND Requests.username= :name AND Requests.username!=""',['name'=>$name,'date'=>$date])->fetchAll('assoc');
        $this->set('request2', $results);
        //$this->set('request3', $results2[0][total_amount]);
        $this->set('request3', $results2[0][total_amount]);
        //$this->set('request3', intval($date));
        $role=$this->Auth->user();
        $this->set('role',$role);
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
        $this->loadModel('DenialReasons');
        $requests2=$this->DenialReasons->find('list', [
    'keyField' => 'id',
    'valueField' => 'denial_reason'
       ]);
        $results2 = $requests2->toArray();
        $this->set('results2',$results2);
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
        
        $requests=$this->Requests->find('all')
                ->where(['id' => $id]);
        $results = $requests->first();
        $this->set('results',$results);
        $this->loadModel('ApprovalReasons');
        $requests2=$this->ApprovalReasons->find('list', [
    'keyField' => 'id',
    'valueField' => 'approval_reason'
       ]);
        $results2 = $requests2->toArray();
        $this->set('results2',$results2);
        if($this->request->data != null)
        {
        $approved=$this->Requests->query();
        $approved->update()
        ->set(['Funded' => 'Approved'])
        ->where(['id' => $id])
        ->execute(); 
        $data = $this->request->data;
        //$test = $data["to"];
        $test=$results->email;
        $subject = $data["subject"];
        $body= $data["Message_Body"];
        $internal_note= $data["internal_note"];
        $this->Requests->updateAll(
        array('internal_note' => "$internal_note"),
        array('id' => $id)
            );
        //$from_addr=$data["from_addr"];
        //$from_name=$data["from_name"];
        $email = new Email('local');
        $email->from("uls-openaccessfund@pitt.edu","ULS - Open Access Fund")
        ->to("$test")
        ->emailFormat('html')
        ->subject("$subject")
        ->send("$body");
        $this->Flash->success(__('The approval mail has been sent.'));
        return $this->redirect(['action' => 'index']);
        }
        
 
    }
    public function deny($id = null){
        
         //or you can load it in beforeFilter()
        
        $requests=$this->Requests->find('all')
                ->where(['id' => $id]);
        $results = $requests->first();
        $this->set('results',$results);
        $this->loadModel('DenialReasons');
        $requests2=$this->DenialReasons->find('list', [
    'keyField' => 'id',
    'valueField' => 'denial_reason'
       ]);
        $results2 = $requests2->toArray();
       // $results2['denial_reason']=striptags($results2['denial_reason'])
        $this->set('results2',$results2);
        if($this->request->data != null)
        {
        $approved=$this->Requests->query();
        $approved->update()
        ->set(['Funded' => 'Denied'])
        ->where(['id' => $id])
        ->execute(); 
        $data = $this->request->data;
        //$test = $data["to"];
        $test=$results->email;
        $subject = $data["subject"];
        $body= $data["Message_Body"];
        //$from_addr=$data["from_addr"];
        //$from_name=$data["from_name"];
        $email = new Email('local');
        $email->from("uls-openaccessfund@pitt.edu","ULS - Open Access Fund")
        ->to("$test")
        ->emailFormat('html')
        ->subject("$subject")
        ->send("$body");
        
        
        }
        
 
    }
    public function pendingrequests()
    {
        
        $requests=$this->Requests->find('all')->where(['Requests.funded' => "pending"]);
        $this->set('requests',$requests);
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
        
        
    }
    public function approvedrequests($user)
    {
        $requests=$this->Requests->find('all')->where(['Requests.funded' => "approved"]);
        $this->set('requests',$requests);
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
    }
    public function paidrequests($user)
    {
        $requests=$this->Requests->find('all')->where(['Requests.funded' => "Paid"]);
        $this->set('requests',$requests);
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
    }
    
    public function denialchecker(){
       $this->viewBuilder()->layout('ajax');
        $this->render('ajax'); 
       if ($this->request->is('ajax') && $this->request->is('get') ){
    //$res = [
     //   'data' => [
      //       /* your data */
        // ]
       //];
       $res= $_GET['id'];
        $this->loadModel('DenialReasons');
        $requests3=$this->DenialReasons->find('all')
                ->where(['DenialReasons.id' => $res]);
        $results3 = $requests3->first()->denial_email;
        //$this->set('results2',$results2);
       return $this->json($results3);
  }
    }
    
  public function approvalchecker(){
       $this->viewBuilder()->layout('ajax');
        $this->render('ajax'); 
       if ($this->request->is('ajax') && $this->request->is('get') ){
    //$res = [
     //   'data' => [
      //       /* your data */
        // ]
       //];
       $res= $_GET['id'];
        $this->loadModel('ApprovalReasons');
        $requests3=$this->ApprovalReasons->find('all')
                ->where(['ApprovalReasons.id' => $res]);
        $results3 = $requests3->first()->approval_email;
        return $this->json($results3);
  }
    }
    public function deniedrequests($user)
    {
         $requests=$this->Requests->find('all')->where(['Requests.funded' => "Denied"]);
        $this->set('requests',$requests);
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
    }
    public function isAuthorized($user)
{ 
        //$this->Flash->success(__($this->request->action));
    // deny index action for certain role
        if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }
    
    
    if ((($this->request->action==="index")||($this->request->action==="approvedrequests") || ($this->request->action==="pendingrequests") || $this->request->action==="paidrequests") &&  $user['role'] === 'payment_team') 
    {
                return true;
    }
    if ((($this->request->action==="index")|| ($this->request->action==="view")||($this->request->action==="approvedrequests") ||  ($this->request->action==="paidrequests")) &&  $user['role'] === 'OSCP_students')
    {
                return true;
    }
    
    
    
}
}
