<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Auth;

use Cake\Http\Response;
use Cake\Http\ServerRequest;
use Cake\Core\Configure;

use Cake\Auth\BaseAuthenticate;
/**
 * Environment Based Authentication adapter for AuthComponent.
 *
 * Provides server environment authentication support for AuthComponent. Env Auth will
 * authenticate users against the configured userModel based on a trusted enviroment
 * variable provided by the server
 *
 * ### Using Basic auth
 *
 * In your controller's components array, add auth + the required settings.
 * ```
 *	public $components = array(
 *		'Auth' => array(
 *			'authenticate' => array('Env')
 *		)
 *	);
 * ```
 *
 * This expects a configuration variable "ENV_USER" to declare which environment 
 * variable represents the username.  For example, "REMOTE_USER" would be common.
 * You should also set `AuthComponent::$sessionKey = false;` in your AppController's
 * beforeFilter() to prevent CakePHP from sending a session cookie to the client.
 *
 * Since this Authentication is stateless you don't need a login() action
 * in your controller. The user credential will be checked on each request. If
 * valid credentials are not provided, an error will be raised
 *
 * You may also want to use `$this->Auth->unauthorizedRedirect = false;`.
 * By default, unauthorized users are redirected to the referrer URL,
 * `AuthComponent::$loginAction`, or '/'. If unauthorizedRedirect is set to
 * false, a ForbiddenException exception is thrown instead of redirecting.
 *
 * @package       Cake.Controller.Component.Auth
 * @since 2.0
 */
class EnvAuthenticate extends BaseAuthenticate {
/**
 * Authenticate a user using Server enviroment. Will use the configured User model.
 *
 * @param CakeRequest $request The request to authenticate with.
 * @param CakeResponse $response The response to add headers to.
 * @return mixed Either false on failure, or an array of user data on success.
 */
    public function authenticate(ServerRequest $request, Response $response)
    {
        return $this->getUser($request);
    }
/**
 * Get a user based on information in the request. Used by cookie-less auth for stateless clients.
 * //TODO: For configuration setting
 * @see https://book.cakephp.org/3.0/en/development/configuration.html
 * @param CakeRequest $request Request object.
 * @return mixed Either false or an array of user information
 */
    public function getUser(ServerRequest $request)
    {
        $username = Configure::read('ENV_USER');
        if (empty($username)) {
            return false;
        }
        $username = preg_replace('/@.*$/', '', $username);
        return $this->_findUser($username);
    }
}
