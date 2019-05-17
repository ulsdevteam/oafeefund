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
use App\Auth\EnvAuthenticate;
use App\Controller\Component\LdapComponent;
use App\Controller\Component\SearchQueryComponent;
use Cake\View\Helper;

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
    /**
     * If an isAuthorized method is not created in a specific Controller,
     * this will be implemented as the default one, such as there isn't one
     * created for the BudgetsController, so both the admin and
     * payment_team will have access to all of it's actions.
     * @return boolean
     */
    public function isAuthorized($user)
    {
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
        $this->loadComponent('Ldap');
        $this->loadComponent('SearchQuery');
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Env' => [
                    'fields' => ['username' => 'user']
                ],
            ],
            'authorize' => ['Controller'],
            'storage' => 'Memory'
        ]);
        $files = glob(WWW_ROOT.'xlsx'.DS.'*'); // get all file names
        foreach($files as $file) { // iterate files
            if(is_file($file))
                $file_time= strtotime(date ("m-d-Y H:i:s.",filemtime($file)));
            $curr_time= strtotime(date ("m-d-Y H:i:s."));
            $diff= abs($file_time-$curr_time);
            $this->Flash->success($diff." ".$diff/60);
            if(($diff/60)>5) {
                unlink($file); // delete file
            }
        }
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Block error messages from PHP error messages, show $user issue
     * Comment beforeRender function to check PHP error messages
     */
    public function beforeRender(Event $event)
    {
        if ($this->Auth->user()) {
            $this->set('role', $this->Auth->user());
        }
    }

}
