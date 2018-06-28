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
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }
    /*
     * Login method
     * 
     * Layout is set to default2.
     * If there is no data present in the input box, while the user first 
     * tries loading the page, it does a check to see if there is a session 
     * saved for the current user and if there is a current session, we redirect 
     * the user to the the default page for that particular role.
     * If data is entered it creates a session for the user.
     * present in the users table.
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     */
    public function login($id = null)
    {
      /* @var String $user1 data entered by user on the login page
       * @var Object $query query the database to find if the specific user is */ 
       $this->viewBuilder()->layout('default2');
       if (empty($this->request->data)) {
           if($this->Auth->user()!= null)
           {
               $role=$this->Auth->user()->role; 
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
                     
        } else if($this->request->data) {
        // Save logic goes here
            $user1=$this->request->data;
            
            //$userconfirmed = $this->Users->find('all', [
            //'conditions' => ['Users.user' => "test"]
            //]);
            
            if($user1 != null)
            {
                //$this->Flash->success(__("Hey, ".$user1['user']));
                $value=$user1['user'];
                $query = $this->Users->find('all')
                        ->where(['Users.user' => "$value"]);
                  
                   
                      //$this->Flash->success(__($query->first()->role));
                      //$role=$query->first()->role;
                      if($query->first()!=null)
                      {
                          $role=$query->first()->role;
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
            }
        }
    }
    /*
     * Logout method
     * 
     * On clicking this button the current session for user will be destroyed.
     */

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
    /*
     * AJAX call made from Requests Template adduser to Users/details.
     * array format containing all the necessary information.
     */
    public function details()
    {
       /* @var String $res , it gives us the username.
        * @var array $var, it gives us the response from LDAP helper in an */
        $this->viewBuilder()->layout('ajax');
         if ($this->request->is('ajax') && $this->request->is('get') )
           {
            $res= $_GET['val'];
            $var= LdapHelper::getInfo($res);
            $this->set("details",json_encode($var));
           }
        $this->render('ajax');
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
        if (isset($user['role']) && $user['role'] === 'admin' ) {
        return true;
    }
      if(isset($user['role']) && (($this->request->action)=="logout"))
      {
          return true;
      }
      //if(($this->request->action)=="details"){
         // return true;
      //}
   }
}
