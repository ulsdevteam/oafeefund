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
     /*
      * This method is called by the RequestsController::approvalchecker() 
      * and RequestsController::denialchecker() to convert the response 
      * which is sent to the view into a json response. 
      * @return json response
      */
        public function json($data)
        {
        $this->response->body(json_encode($data));
        return $this->response;
        }  
        /*
         * If an isAuthorized method is not created in a specific Controller,
         * this will be implemented as the default one, such as there isn't one
         * created for the BudgetsController, so both the admin and 
         * payment_team will have access to all of it's actions.
         * @return boolean 
         */
        public function isAuthorized($user) {
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        if (isset($user['role']) && $user['role'] === 'payment_team') {
            return true;
        }
       // Default deny
        return false;
       }
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     * The Auth component is loaded to authenticate 
     * the username field matches the user in the 
     * user table.
     * The storage is a session so we do have a session 
     * saved on the server, when the client logs in, 
     * so the client doesn't have to login again.
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
        'loginAction' => [
            'controller' => 'Users',
            'action' => 'login'
        ],
        'authorize' => array('Controller'), // Added this line
        'storage' => 'Session'
    ]);  

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }  
    /*
     * The beforeFilter is applied before accessing the controller requested.
     * The AddUser page in Requests can be accessed by anyone without any 
     * authentication.
     * @param Cake\Event\Event Object $event, used to get the current event
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        switch ($this->name) # We get the controller name
        { 
        case 'Requests':
            $this->Auth->allow(['addUser','saved']); // Allowed if method is addUser or saved
            break;
        case 'Users':
            $this->Auth->allow(['details']); // Allowed if method is details
            break;
        }
    }
}
