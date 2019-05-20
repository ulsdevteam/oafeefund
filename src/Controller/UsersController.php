<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use App\Controller\Component\LdapComponent;

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
                if ($user->user == $this->Auth->user('user') && $user->user != 'admin') {
                    return $this->redirect(['controller' => 'requests', 'action' => 'index']);
                } else {
                    return $this->redirect(['action' => 'index']);
                }

            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }
    /*
     * AJAX call made from Requests Template submit to Users/details.
     * array format containing all the necessary information.
     */
    public function details()
    {
        /* @var String $res , it gives us the username.
         * @var array $var, it gives us the response from LDAP helper in an */
        $this->viewBuilder()->layout('ajax');
        if ($this->request->is('ajax') && $this->request->is('get') ) {
            $res= $_GET['val'];
            $var= $this->Ldap->getInfo($res);
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
        parent::isAuthorized($user);
        if (isset($user['role']) && $user['role'] === 'admin' ) {
            return true;
        }
      //if(($this->request->action)=="details"){
         // return true;
      //}
        return false;
    }
}
