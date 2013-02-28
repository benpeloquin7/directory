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
            
            // TODO clean this section up
            
            $nameArr = $this->parseEmailForName($this->Session->read('User.email'));
            
            if($this->Session->read('User.email') == $c['email']) {
                $this->Session->write('User.firstName', $nameArr[0]);
                $this->Session->write('User.lastName', $nameArr[1]);
            } else {
                // TODO rewrite the cookie with the session information
                $this->Cookie->destroy();
                $this->Cookie->write('GSPUser',
                    array('email' =>$this->Session->read('User.email'), 'firstName' => $nameArr[0], 'lastName' => $nameArr[1]),
                    false,
                    604800
                );
            }
            
        }
    }
    
    public function initiate() {
        
        if($this->Session->check('User.email')) {
            // check email against partner_app db
            $options = array('conditions' => array('User.email' => $this->Session->read('User.email')));
            $user = $this->User->find('first', $options);

            if($user) {
                $this->Session->write('User.id', $user['User']['id']);
                $this->Session->write('User.firstName', $user['User']['first_name']);
                $this->Session->write('User.lastName', $user['User']['last_name']);
                
                $this->redirect(array('controller' => 'hoodies', 'action' => 'populate'));
            } else {
                // create new record and then redirect to hoodies
                $nameArr = $this->parseEmailForName($this->Session->read('User.email'));

                $record = array(
                    'User' => 
                        array(
                            'first_name' => $nameArr['firstName'], 
                            'last_name' => $nameArr['lastName'], 
                            'email' => $this->Session->read('User.email')
                        )
                    );

                $this->User->create();
                if($this->User->save($record)) {
                    $options = array('conditions' => array('User.email' => $this->Session->read('User.email')));
                    $user = $this->User->find('first', $options);

                    $this->Session->write('User.id', $user['User']['id']);
                    $this->Session->write('User.firstName', $user['User']['first_name']);
                    $this->Session->write('User.lastName', $user['User']['last_name']);
         
                    $this->redirect(array('controller' => 'hoodies', 'action' => 'populate'));
                } else {
                    // redirect to login screen???
                    $this->redirect(array('controller' => 'people', 'action' => 'challenge'));
                }
            }
        }
    }
    
    public function main() {
        
        $session = $this->Session->read();
        
        $hoody_size = '';
        $hoody_letter = '';
        
        if(!empty($session['Hoody']['order'])) {
            // we a hoodie vote
            $hoody_size = $session['Hoody']['order']['Hoody']['size'];
            $hoody_letter = $session['Hoody']['order']['Hoody']['letter'];
        }
        
        
        
        // TODO figure out if votes is not empty and set a votes variable
        
        $voting_modules = array();
        
        foreach($session['Polls']['all'] as $poll) {
            
            $poll_id = $poll['polls']['id'];
            
            $votes_length = count($session['Votes']['all']);
            
            $vote_answer = '';
            
            for($i = 0; $i < $votes_length; $i++) {
                if($session['Votes']['all'][$i]['Vote']['poll_id'] == $poll_id) {
                    $vote_answer = $session['Votes']['all'][$i]['Vote']['answer'];
                }
            }
            
            $tally = $this->Session->read('Votes.tally');
            
            $voting_modules[] = array(
                'id' => $poll_id,
                'question' => $poll['polls']['question'],
                'answer_a' => $poll['polls']['answer_a'],
                'answer_b' => $poll['polls']['answer_b'],
                'previous_answer' => $vote_answer,
                'tally' => $tally[$poll_id]
            );
        }
        
        $this->set('session', $session);
        $this->set('hoody_size', $hoody_size);
        $this->set('hoody_letter', $hoody_letter);
        $this->set('voting_modules', $voting_modules);
    }
    
    private function parseEmailForName($e) {
        
        // TODO handle an exception where emails have more than one "_" in them - like Margret_brett_kearns@gspsf.com or something

        $e = str_replace('@gspsf.com', '', $e);

        $arr = explode('_', $e);

        $firstName = ucfirst($arr[0]);
        $lastName = ucfirst($arr[1]);

        return array($firstName, $lastName, 'firstName' => $firstName, 'lastName' => $lastName);
    }
}