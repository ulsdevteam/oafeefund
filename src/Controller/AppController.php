<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use App\View\Helper\LdapHelper;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{   
    
  //  public $helpers = ['TinyMCE.TinyMCE'];
        public function json($data)
                {
        //$this->response->type('json');
        $this->response->body(json_encode($data));
        return $this->response;
    }
        protected function setJsonResponse(){
    $this->loadComponent('RequestHandler');
    $this->RequestHandler->renderAs($this, 'json');
    $this->response->type('application/json');
}
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        
        //$this->loadHelper('LdapHelper');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth',[
        'authenticate' => [
            'Form' => [
                'fields' => ['username' => 'user']
            ]
        ],
        'authorize' => array('Controller'), // Added this line
        'storage' => 'Session'
    ]);
       $this->loadModel('cron_checks'); 
        
        
        

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }
    public function isAuthorized($user) {
    // Admin can access every action
    if (isset($user['role']) && $user['role'] === 'admin') {
        return true;
    }
    if (isset($user['role']) && $user['role'] === 'payment_team') {
        //$this->Flash->success(__($controller));
        return true;
    }

    // Default deny
    return false;
       }
    
    
    public function beforeFilter(Event $event)
    {
        
        //$role=$this->Auth->user()->user;
        //$this->Flash->success(__($this->request->action)); 
        /*if($role=="admin")
        {
            $this->Auth->allow();
        }
        if($role=="payment_team")
        {
        switch ($this->name) # this will allow everyone to access addUSer page of Requests https://stackoverflow.com/questions/2793629/cakephp-auth-how-to-allow-specific-controller-and-actions
        { 
        case 'Requests':
            $this->Auth->allow(['view', 'index']);
            break;
        case 'Users':
            $this->Auth->deny();
            break;
        
        }
        
        }*/
        switch ($this->name) # This will allow everyone to access addUSer page of Requests.
        { 
        case 'Requests':
            $this->Auth->allow(['addUser']);
            break;
        }
    }
}
