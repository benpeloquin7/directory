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

class HoodiesController extends AppController {

    public $name = 'Hoodies';
        
    public $components = array('Cookie', 'Session');
    
    private $output = array('response' => false, 'redirect' => '', 'message' => '', 'data' => array());
    
    function beforeFilter() {
        parent::beforeFilter();
        
        // have cookie and have session
        if(!$this->Session->check('User.id')) {
            $this->redirect(array('controller' => 'people', 'action' => 'challenge'));
        }
    }
    
    public function populate() {
        $options = array('conditions' => array('Hoody.user_id' => $this->Session->read('User.id')));
        $hoody = $this->Hoody->find('first', $options);
        
        $this->Session->write('Hoody.order', $hoody);
        $this->redirect(array('controller' => 'polls', 'action' => 'populate'));
    }
    
    public function submit() {
        
        // set the response up for ajax requests
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->response->type('json');
        
        // default output
        $url = Router::url(array('controller' => 'users', 'action' => 'main'));
        $this->output['response'] = false;
        $this->output['redirect'] = $url;
        $this->output['message'] = 'Sorry, we were unable to process your hoodie order. Please try again later. If the problem persists please send an angry email to your network administrator.';
        $this->output['data'] = array();
        
        // request must be post
        if($this->request->is('post')) {
            
            // gather raw data
            $size = $this->request->data('Hoody.size');
            $letter = $this->request->data('Hoody.letter');
            
            // both values required and must not be empty
            if(!empty($size) && !empty($letter)) {
                
                // sanitize - don't trust data
                $size = filter_var($size, FILTER_SANITIZE_STRING);
                $letter = filter_var($letter, FILTER_SANITIZE_STRING);
                
                // check to see if they've already order the hoodie
                $options = array('conditions' => array('Hoody.user_id' => $this->Session->read('User.id')));
                $hoody = $this->Hoody->find('first', $options);
                
                // if we already have a hoody order
                if(isset($hoody['Hoody']['id'])) {
                    
                    $this->update_order($hoody['Hoody']['id'], $size, $letter);
                    
                } else {
                    
                    $this->new_order($size, $letter);
                    
                }
            }
        }
        
        $this->response->body(json_encode($this->output));
        $this->response->send();
        $this->_stop();
    }
    
    
   /**
    * Create a new record for the hoodie order
    *
    * @param Required $size String The size of the hoodie
    * @param Required $letter String The letter of the new hoodie
    * @return boolean true if the record was created, false if not
    */
    private function new_order($size, $letter) {
        
        // TODO figure our if I should validate hoodie data
        
        $record = array(
            'Hoody' => array(
                'user_id' => $this->Session->read('User.id'),
                'size' => $size,
                'letter' => $letter
            )
        );

        $this->Hoody->create();

        if($this->Hoody->save($record)) {
            $options = array('conditions' => array('Hoody.user_id' => $this->Session->read('User.id')));
            $new_hoody = $this->Hoody->find('first', $options);

            $this->Session->write('Hoody.order', $new_hoody);
            
            $this->output['response'] = true;
            $this->output['message'] = 'New hoody ordered successfully.';
            $this->output['data'] = $new_hoody;
            
            return true;
            
        }
        
        $this->output['response'] = false;
        $this->output['message'] = 'Unable to order new hoodie.';
        $this->output['data'] = array();

        return false;
    }
    
    /**
    * Update a record for the hoodie order
    *
    * @param Required $id Int The id of the hoodie record to update
    * @param Required $size String The size of the hoodie
    * @param Required $letter String The letter of the new hoodie
    * @return boolean true if the record was updated, false if not
    */
    private function update_order($id, $size, $letter) {
        
        // TODO find our if I should validate data here
        
        $record = array(
            'Hoody' => array(
                'id' => $id,
                'user_id' => $this->Session->read('User.id'),
                'size' => $size,
                'letter' => $letter
            )
        );

        $this->Hoody->id = $id;
        
        if($this->Hoody->save($record)) {
            $options = array('conditions' => array('Hoody.user_id' => $this->Session->read('User.id')));
            $new_hoody = $this->Hoody->find('first', $options);
            
            $this->Session->write('Hoody.order', $new_hoody);
            
            $this->output['response'] = true;
            $this->output['message'] = 'Successfully updated your hoodie order.';
            $this->output['data'] = $new_hoody;
            
            return true;
        }
        
        $this->output['response'] = false;
        $this->output['message'] = 'Unable to update your hoodie order.';
        $this->output['data'] = array();

        return false;
    }
}