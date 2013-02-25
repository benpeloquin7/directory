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
        if($this->Cookie->check('GSPUser') && !$this->Session->check('User.email')) {
            
            // check the db
            $user_cookie = $this->Cookie->read('GSPUser');
            if(isset($user_cookie['email'])) {
                $options = array('conditions' => array('People.email' => $user_cookie['email']));
                $result = $this->Bouncer->find('first', $options);
                
                if($result) {
                    // TODO: the email came back legit, set the challenge email
                    $nameArr = $this->parseEmailForName($result['Bouncer']['email']);
                    $this->preset_user_information['first_name'] = $nameArr[0];
                    $this->preset_user_information['last_name'] = $nameArr[1];
                    $this->preset_user_information['email'] = $user_cookie['email'];
                    
                }
            }
            
//            if($result) {
//                $nameArr = $this->parseEmailForName($result['User']['email']);
//                
//                $this->Session->write('User.id', $result['User']['id']);
//                $this->Session->write('User.email', $result['User']['email']);
//                $this->Session->write('User.firstName', $nameArr[0]);
//                $this->Session->write('User.lastName', $nameArr[1]);
//            }
        }
        
        if(!$this->Cookie->check('GSPUser') && $this->Session->check('User.email')) {
            $this->Session->delete('User');
        }
    }

    /**
     * Displays a view with an email challenge
     * @return void
     */
    public function challenge() {

        // if the email is already found in a cookie then it will be set here
        $this->set('preset_user_information', $this->preset_user_information);
        // if session found, redirect to next step
        
    }
        
        
        
    /**
     * Checks the submitted email against all legit emails in the mgspsf db
     * @return void
     */
    public function checkTheList() {

        $this->autoRender = false;

        $allowed = $this->Bouncer->checkTheList();

        if($allowed) {
            $this->redirect(array('controller' => 'hoodies', 'action' => 'check_order'));
        } else {
            $this->redirect(array('controller' => 'bouncer', 'action' => 'challenge', 'warning' -> 'NotOnTheList'));
        }
    }
    
    // parses email and returns an array of first and last names (uppercase)
    private function parseEmailForName($e) {

        $e = str_replace('@gspsf.com', '', $e);

        $arr = explode('_', $e);

        $firstName = ucfirst($arr[0]);
        $lastName = ucfirst($arr[1]);

        return array($firstName, $lastName);
    }
}
