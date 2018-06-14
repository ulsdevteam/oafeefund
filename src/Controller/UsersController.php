<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use App\View\Helper\LdapHelper;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
          public function details()
                  {
        $this->viewBuilder()->layout('ajax');
        $this->render('ajax'); 
       if ($this->request->is('ajax') && $this->request->is('get') )
           {
       $res= $_GET['val'];
       $var= LdapHelper::getInfo($res);
       //$this->set('var', $var);
       echo json_encode($var);
           }
 // echo "AJAX call failed";

    }
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }
    public function login($id = null)
    {
        $this->viewBuilder()->layout('default2');
        $val="You are already logged in as";
       if (empty($this->request->data)) {
           if($this->Auth->user()!= null)
           {
       $this->Flash->success(__("{$val} {$this->Auth->user()->user}"));
           }
        } else if($this->request->data) {
        // Save logic goes here
            $user1=$this->request->data;
            
            //$userconfirmed = $this->Users->find('all', [
            //'conditions' => ['Users.user' => "test"]
            //]);
            
            if($user1 != null)
            {
                $this->Flash->success(__("Hey, ".$user1['user']));
                $value=$user1['user'];
                $query = $this->Users->find('all')
                        ->where(['Users.user' => "$value"]);
                  
                   
                      //$this->Flash->success(__($query->first()->role));
                      $role=$query->first()->role;
                      if($query->first()!=null)
                      {
                      $this->Auth->setUser($query->first());
                      if($role === 'admin')
                      {
                        $this->redirect(array("controller" => "Requests", 
                      "action" => "index"));   
                      }
                      else if($role === 'OSCP_students')
                      {
                          $this->redirect(array("controller" => "Articles", 
                      "action" => "index"));
                      }
                      else if($role === 'payment_team')
                      {
                          $this->redirect(array("controller" => "Requests", 
                      "action" => "approvedrequests"));
                      }
                      }
                      else
                      {
                      $this->Flash->error(__('Username or password is incorrect'));
                      }
                      
                      //$user = $this->Auth->identify();
                      /*if ($user) 
                          {
                              $this->Auth->setUser($query->first());
                              return $this->redirect($this->Auth->redirectUrl());
                          } 
                   else 
                       {
                              $this->Flash->error(__('Username or password is incorrect'));
                      }*/
                /*$query = $this->Users->find('all', [
                         'conditions' => ['Users.user' => "$value"],
                         'fields'=>array('role')
                         
                          ]);*/
                //$userconfirmed=$query->jsonSerialize();
                
                /*$userconfirmed=$query->toArray();
                $userconfirmed1=$userconfirmed;
                $this->Flash->success(var_export($userconfirmed1, true));
                $this->Flash->success(__($userconfirmed1));*/
                
                
            }
            //$this->Flash->success(__($userconfirmed));
            //if($this->request->data = $this->Users->find('all');
            
        }
        
        
        /*if ($this->request->is('post')) 
      {
        $user = $this->Auth->identify();
        $user = $this->Users->find('all',[
            'conditions' => ['users.user' => "$user"]
           ]);
           $number = $user->count();
           
       }*/  
    }

    public function logout()
    {
        $this->viewBuilder()->layout('default2');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function isAuthorized($user)
   { 
        //$this->Flash->success(__($this->request->action));
    // deny index action for certain role
        if (isset($user['role']) && $user['role'] === 'admin' ) {
        return true;
    }
      if(isset($user['role']) && (($this->request->action)=="logout"))
      {
          return true;
      }
   }
}
