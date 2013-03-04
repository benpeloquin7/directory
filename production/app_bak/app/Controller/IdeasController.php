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

class IdeasController extends AppController {

    public $name = 'Ideas';
        
    public $components = array('Cookie', 'Session');
    
    private $output;
    
    function beforeFilter() {
        parent::beforeFilter();
        
        // dont have a session but do have a cookie
        if($this->Cookie->check('GSPUser') && !$this->Session->check('User.email')) {
            $this->redirect(array('controller' => 'people', 'action' => 'challenge'));
        }
        
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
        $this->output['message'] = 'Sorry, we couldn\'t save your idea, write it down on the nearest cocktail napkin and try sending it again later...';
        $this->output['data'] = array();
        
        // request must be post
        if($this->request->is('post')) {
            
            // gather raw data
            $idea = $this->request->data('Idea.idea');
            
            // both values required and must not be empty
            if(!empty($idea)) {
                
                // sanitize - don't trust data
                $idea = filter_var($idea, FILTER_SANITIZE_STRING);
                
                $record = array(
                    'Idea' => array(
                        'user_id' => $this->Session->read('User.id'),
                        'idea' => $idea
                    )
                );

                $this->Idea->create();

                if($this->Idea->save($record)) {
                    
                    $this->output['response'] = true;
                    $this->output['message'] = 'We love it! We\'ll get back to you on that.';
                    $this->output['data'] = $this->Idea->id;

                } else {
                    $this->output['data'] = $record;
                }

            }
        }
        
        $this->response->body(json_encode($this->output));
        $this->response->send();
        $this->_stop();
    }

}