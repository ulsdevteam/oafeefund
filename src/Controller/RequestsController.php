<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use App\Controller\Component\LdapComponent;
use Cake\Datasource\ConnectionManager;
use App\Controller\Component\SearchQueryComponent;
//use Cake\Database\Schema\TableSchema;
/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 *
 * @method \App\Model\Entity\Request[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RequestsController extends AppController
{
    /*
     * Add new request method.(adduser)
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
         /* Now here you can put your default values */
	
        $this->viewBuilder()->layout('default2'); // This creates a blank template from the Layout, overides the default one.
        
        $request = $this->Requests->newEntity();
        $res="hok14"; // test case, replace with env('HTTP_EDUPERSONPRINCIPALNAME')
        $var= $this->Ldap->getInfo($res);
        $this->set("details",$var);
        if ($this->request->is('post')) {
            $request = $this->Requests->patchEntity($request, $this->request->getData());
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been submitted.'));
               return $this->redirect(['action' => 'saved']);
            }
            $this->Flash->error(__('The request could not be saved. Please, try again.'));
        }
        $denialReasons = $this->Requests->DenialReasons->find('list', ['limit' => 200]); 
        //@var Object $denialReasons It consists of the denialreasons.
        $this->set(compact('request', 'denialReasons'));
        $this->render("adduser");
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
        $this->viewBuilder()->layout('default');
        $this->paginate = [
            'contain' => ['DenialReasons', 'Articles']
        ];
        $requests = $this->paginate($this->Requests);
        $this->set(compact('requests'));
        $role=$this->Auth->user();
        $this->set('role',$role);
    }

    public function search()
    {
        $parameter = $this->request->query('Parameter');
        $value = $this->request->query('value');
        $action = $this->request->query('action');
        $where_clause= $this->SearchQuery->getRequests($action,$parameter,$value);
        if($where_clause== false){
            $this->redirect(['action' => 'index']); 
        }
        $requests=$this->Requests->find('all')->where($where_clause);
        $requests_for_count=$requests->toArray();
        $count= sizeof($requests_for_count);
        $this->set('prev_action',$action);
        $this->set(compact('count','parameter','requests','value'));
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
        $this->render("index");
    }	

    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    
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
       $date= date('m');
       $results3 = $connection->execute('SELECT Requests.inquiry_date AS inquiry_date FROM requests Requests WHERE Requests.id= :id',['id'=>$id])->fetchAll('assoc');
       $date= $results3[0]["inquiry_date"]; 
       $results2 = $connection->execute('SELECT ROUND(SUM(Requests.amount_requested),2) As total_amount FROM requests Requests, budgets Budgets WHERE Budgets.budget_date_begin<=:date AND Budgets.budget_date_end>=:date AND Requests.username= :name AND Requests.username!="" AND (Requests.funded= "Approved" OR Requests.funded="Paid")',['name'=>$name,'date'=>$date])->fetchAll('assoc');
        //$this->set('request2', $results);
        //$this->set('request3', $results2[0][total_amount]);
        $this->set('request3', $results2[0]["total_amount"]);
        //$this->set('request3', intval($date));
        $role=$this->Auth->user();
        $this->set('role',$role);
    }
    public function export(){
        $parameter = $this->request->query('parameter');
        $value = $this->request->query('value');
        $action = $this->request->query('action');
        if($value!=null && $parameter!=null){
           $where_clause= $this->SearchQuery->getRequests($action,$parameter,$value);
        }
        else{
           $where_clause= $this->SearchQuery->getRequests($action);
        }
        if($where_clause== false){
            $this->redirect(['action' => 'index']); 
        }
        $requests=$this->Requests->find('all')
                    ->where($where_clause)
                ->contain(['DenialReasons', 'Articles', 'Transactions']);
        
        $data = $requests;
        $this->response->download('export.csv');
        //$_header=["id"];
	//$_extract=['id','username','transaction.amount_paid'];
        $column_values_requests=$this->SearchQuery->setCsvColumns($this->Requests->schema()->columns());
        $this->loadModel('Transactions');
        $column_values_transactions=$this->SearchQuery->setCsvColumns($this->Transactions->schema()->columns(),'transaction');
        $this->loadModel('DenialReasons');
        $column_values_denial_reasons=$this->SearchQuery->setCsvColumns($this->DenialReasons->schema()->columns(),'denial_reason');
        $this->loadModel('Articles');
        $column_values_articles=$this->SearchQuery->setCsvColumns($this->Articles->schema()->columns(),'article');
        $column_values=array_merge($column_values_requests,$column_values_transactions,$column_values_denial_reasons,$column_values_articles);
        $_extract=$column_values;
        $_header=$column_values;
        $this->set(compact('column_values'));
        $_serialize = 'data';
   	$this->set(compact('data', '_serialize','_extract','_header'));
	$this->viewBuilder()->className('CsvView.Csv');
	return;
        
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
    /*
     *  Approve method
     * 
     * @param string|null $id Request id.
     */
    public function approve($id = null){
        /*
         * @var array $results, contains an array 
         * of the request for requested id 
         * @var array $results2 , contains an array 
         * of the Approved reasons, with id and approval reason. 
         * @var Cake\Mailer\Email Object $email, contains the email template 
         * to be sent.
         */
        
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
     /*
     *  Denial method
     * 
     * @param string|null $id Request id.
     * @return void
     */
    public function deny($id = null){
        /*
         * @var array $results, contains an array 
         * of the request for requested id 
         * @var array $results2 , contains an array of the Denial reasons,
         * with id and denial reason. 
         * @var Object $email, contains the email template to be sent
         */
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
        $data = $this->request->data;
        $approved=$this->Requests->query();
        $approved->update()
        ->set(['Funded' => 'Denied','denial_id' => $data["id"]])
        ->where(['id' => $id])
        ->execute();
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
        //$this->Flash->success(__($data));
        $this->Flash->success(__('The denial mail has been sent.'));
        return $this->redirect(['action' => 'index']);
        
        
        }
        
 
    }
    /*
     * Pending requests method
     * 
     * Show all requests which are still pending
     * @return void
     */
    public function pendingrequests()
    {
        /* @var Object $requests , entity which contains all pending requests
         * @var array $role, user information.*/
        $requests=$this->Requests->find('all')->where(['Requests.funded' => "pending"]);
        $this->set('requests',$requests);
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
        $this->render("index");
        
        
    }
    /*
     * Approved requests method
     * 
     * Show all requests which are approved
     * @return void
     */
    public function approvedrequests()
    {
        /* @var Object $requests , entity which contains all approved requests
         * @var array $role, user information. */
        $requests=$this->Requests->find('all')->where(['Requests.funded' => "approved"]);
        $this->set('requests',$requests);
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
        $this->render("index");
    }
    /*
     * Paid requests method
     * 
     * Show all requests which are paid
     * @return void
     */
    public function paidrequests()
    { 
        /* @var Object $requests , entity which contains all paid requests
        * @var array $role, user information.*/
        $requests=$this->Requests->find('all')->where(['Requests.funded' => "Paid"]);
        $this->set('requests',$requests);
        $this->paginate = [
            'contain' => ['DenialReasons', 'Articles']
        ];
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
        $this->render("index");
    }
    /*
     * Denied requests method
     * 
     * Show all requests which are denied
     * @return void
     */
    public function deniedrequests()
    {
        /* @var Object $requests , entity which contains all denied requests
         * @var array $role, user information.*/
        $requests=$this->Requests->find('all')->where(['Requests.funded' => "Denied"]);
        $this->set('requests',$requests);
        $requests = $this->paginate($requests);
        $role=$this->Auth->user();
        $this->set('role',$role);
        $this->render("index");
    }
    /*
     * Denial Checker method
     * 
     * AJAX method call, which checks the ID of the denial reason
     * and responds with the Denial reason email
     * 
     * @return json format of $results3
     */
    public function denialchecker(){
        /*@var String $results3 , string which contains the denial email*/
       $this->viewBuilder()->layout('ajax');
       if ($this->request->is('ajax') && $this->request->is('get') ){
        $res= $_GET['id'];
        $this->loadModel('DenialReasons');
        $requests3=$this->DenialReasons->find('all')
                ->where(['DenialReasons.id' => $res]);
        $results3 = $requests3->first()->denial_email;
        //$this->set('results2',$results2);
       $this->set("details",json_encode($results3));
       $this->render('ajax'); 
  }
    }
    /*
     * Approved Checker method
     * 
     * AJAX method call, which checks the ID of the approval reason
     * and responds with the approval reason email
     * @return json format of $results3
     */
  public function approvalchecker(){
      /*@var String $results3 , string which contains the approval email*/
       $this->viewBuilder()->layout('ajax');
       if ($this->request->is('ajax') && $this->request->is('get') ){
       $res= $_GET['id'];
        $this->loadModel('ApprovalReasons');
        $requests3=$this->ApprovalReasons->find('all')
                ->where(['ApprovalReasons.id' => $res]);
        $results3 = $requests3->first()->approval_email;
        $this->set("details",json_encode($results3));
        $this->render('ajax'); 
        
  }
    }
    
    
    public function reports(){
         $query1=$this->Requests->find('all');
         $query1->select([
            'Requests.school',
            'count' => $query1->func()->count('*'),
         ])
        ->group('Requests.school')
        ->order(['count' => 'DESC']);
         $query1->hydrate(false); // Results as arrays instead of entities
         $result = $query1->toList();
         $result= json_encode($result);
         $this->set('query1',$result);
    }
    /*
     * Test method created to check if schoolRequests and other actions for the reports wopuld work fine.
     * 
     * public function getDates(){
        $this->viewBuilder()->layout('ajax');
        $FY='';
        $where_clause= $this->SearchQuery->getDates($FY);
        //$this->set("details",$where_clause);
        $query1=$this->Requests->find('all');
        $query1->select([
       'parameter'=>'Requests.school',
       'value' => $query1->func()->count('*'),
        ])
       ->group('Requests.school')
       ->order(['value' => 'DESC'])
       ->where($where_clause);
        $query1->hydrate(false); // Results as arrays instead of entities
        $result = $query1->toList();
        $this->set("details", json_encode($result));
        $this->render('ajax');
    }*/

    public function schoolRequests(){
         $this->viewBuilder()->layout('ajax');
         if ($this->request->is('ajax') && $this->request->is('get') )
           {
             $FY= $_GET['FY'];
             $where_clause= $this->SearchQuery->getDates($FY);
             $query1=$this->Requests->find('all');
            $query1->select([
           'parameter'=>'Requests.school',
           'value' => $query1->func()->count('*'),
            ])
           ->group('Requests.school')
           ->order(['value' => 'DESC'])
           ->where($where_clause);
            $query1->hydrate(false); // Results as arrays instead of entities
            $result = $query1->toList();
            $this->set("details", json_encode($result));
           }
        $this->render('ajax');
    }
        public function budgetRequests(){
         $this->viewBuilder()->layout('ajax');
         if ($this->request->is('ajax') && $this->request->is('get') )
           {
             $FY= $_GET['FY'];
             $where_clause= $this->SearchQuery->getDates($FY);
             $query1=$this->Requests->find('all');
            $query1->select([
           'parameter'=>'Requests.school',
           'value' => $query1->func()->sum('Requests.amount_requested'),
            ])
           ->group('Requests.school')
           ->order(['value' => 'DESC'])
           ->where($where_clause);
            $query1->hydrate(false); // Results as arrays instead of entities
            $result = $query1->toList();
            $this->set("details", json_encode($result));
           }
        $this->render('ajax');
    }
    public function publisherCosts(){
         $this->viewBuilder()->layout('ajax');
                      $query1=$this->Requests->find('all');
         if ($this->request->is('ajax') && $this->request->is('get') )
           {
             $FY= $_GET['FY'];
             $where_clause= $this->SearchQuery->getDates($FY);
             $query1=$this->Requests->find('all');
            $query1->select([
           'parameter'=>'Requests.publisher',
           'value' => $query1->func()->sum('Requests.amount_requested'),
            ])
           ->group('Requests.publisher')
           ->order(['value' => 'DESC'])
           ->where($where_clause);
            $query1->hydrate(false); // Results as arrays instead of entities
            $result = $query1->toList();
            $this->set("details", json_encode($result));
           }
        $this->render('ajax');
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
        if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }
    
    
    if ((($this->request->action==="index")||($this->request->action==="approvedrequests") || ($this->request->action==="pendingrequests") || $this->request->action==="paidrequests") || ($this->request->action==="view") &&  $user['role'] === 'payment_team') 
    {
                return true;
    }
    if ((($this->request->action==="index")|| ($this->request->action==="view")||($this->request->action==="approvedrequests") ||  ($this->request->action==="paidrequests")) &&  $user['role'] === 'OSCP_students')
    {
                return true;
    }
   
    }
}
