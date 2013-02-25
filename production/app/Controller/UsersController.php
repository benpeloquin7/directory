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

class UsersController extends AppController {

    public $name = 'Users';
        
    public $components = array('Cookie', 'Session');
    
    function beforeFilter() {
        parent::beforeFilter();
        
        // dont have a session but do have a cookie
        if($this->Cookie->check('GSPUser') && !$this->Session->check('User.email')) {
            $this->redirect(array('controller' => 'people', 'action' => 'challenge'));
        }
        
        // dont have cookie but do have session
        if(!$this->Cookie->check('GSPUser') && $this->Session->check('User.email')) {
            
            $nameArr = $this->parseEmailForName($this->Session->read('User.email'));
            
            $this->Cookie->write('GSPUser',
                array('email' =>$this->Session->read('User.email'), 'firstName' => $nameArr[0], 'lastName' => $nameArr[1]),
                false,
                604800
            );
        }
        
        // have neither cookie nor session
        if(!$this->Cookie->check('GSPUser') && !$this->Session->check('User.email')) {
            $this->redirect(array('controller' => 'people', 'action' => 'challenge'));
        }
        
        // have cookie and have session
        if($this->Cookie->check('GSPUser') && $this->Session->check('User.email')) {
            
            $c = $this->Cookie->read('GSPUser');
        
            if($this->Session->read('User.email') == $c['email']) {
                $nameArr = $this->parseEmailForName($this->Session->read('User.email'));
                $this->Session->write('User.firstName', $nameArr[0]);
                $this->Session->write('User.lastName', $nameArr[1]);
            } else {
                // TODO rewrite the cookie with the session information
            }
            
        }
    }
    
    public function initiate() {
        
        // check email against partner_app db
        $options = array('conditions' => array('User.email' => $this->Session->read('User.email')));
        $user = $this->User->find('first', $options);
        
        if($user) {
            // TODO double check the format for grabbing the id here
            $this->Session->write('User.id', $user['User']['id']);
            $this->redirect(array('controller' => 'hoodies', 'action' => 'populate'));
        } else {
            // create new record and then redirect to hoodies
            
            $record = array(
                'User' => 
                    array(
                        'firstName' => $this->Session->read('User.firstName'), 
                        'lastName' => $this->Session->read('User.lastName'), 
                        'email' => $this->Session->read('User.email')
                    )
                );
            
            $this->User->create();
            if($this->User->save($record)) {
                $options = array('conditions' => array('User.email' => $this->Session->read('User.email')));
                $user = $this->User->find('first', $options);
                
                $this->Session->write('User.id', $user['User']['id']);
                
                $this->redirect(array('controller' => 'hoodies', 'action' => 'populate'));
            } else {
                // redirect to login screen???
                $this->redirect(array('controller' => 'people', 'action' => 'challenge'));
            }
        }
        
    }
    
    public function main() {
        $this->set('session', $this->Session->read());
    }
    
    private function parseEmailForName($e) {

        $e = str_replace('@gspsf.com', '', $e);

        $arr = explode('_', $e);

        $firstName = ucfirst($arr[0]);
        $lastName = ucfirst($arr[1]);

        return array($firstName, $lastName);
    }
}