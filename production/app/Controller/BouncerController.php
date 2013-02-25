<?php
/**
 * Authorization controller.
 *
 * This file will render views from view/Auth/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

class BouncerController extends AppController {

    public $name = 'Bouncer';
        
    public $components = array('Cookie', 'Session');
    
    private $preset_user_information = array('first_name' => '', 'last_name' => '', 'email' => '');

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Bouncer');
        
    function beforeFilter() {
        parent::beforeFilter();
        
        // if we have a cookie but we don't have a session
        if($this->Cookie->check('GSPUser')) {
            
            $user_cookie = $this->Cookie->read('GSPUser');
            if(isset($user_cookie['email'])) {
                $this->preset_user_information['email'] = $user_cookie['email'];
            }
            
        }
        
    }

    /**
     * Displays a view with an email challenge
     * @return void
     */
    public function challenge() {
        $this->set('preset_user_information', $this->preset_user_information);
    }
       
    /**
     * Checks the submitted email against all legit emails in the mgspsf db
     * @return boolean True for allowed, False for not allowed
     */
    public function checkTheList() {
        
        $this->response->type('json');
        $url = Router::url(array('controller' => 'bouncer', 'action' => 'challenge'));
        $response = array('response' => false, 'redirect' => $url, 'message' => 'Sorry but we couldn\'t find you in our records. Please check your email and try again. If the problem persists, please contact your network administrator.');
        
        if($this->request->is('post')) {
            $options = array('conditions' => array('People.email' => $this->request->data('User.email')));
            $allowed = $this->Bouncer->find('first', $options);
            
            if($allowed) {
                $this->Session->write('User.email', $this->request->data('User.email'));
                $url = Router::url(array('controller' => 'users', 'action' => 'initiate'));
                $response = array('response' => true, 'redirect' => $url, 'message' => 'User authenticated.');
            }
        }
        
        $this->response->body(json_encode($response));
        $this->response->send();

    }
    
}
