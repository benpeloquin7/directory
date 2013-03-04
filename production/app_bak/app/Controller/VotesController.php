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

class VotesController extends AppController {

    public $name = 'Votes';
        
    public $components = array('Cookie', 'Session');
    
    private $output = array('response' => false, 'redirect' => '', 'message' => '', 'data' => array(), 'tally' => array());
    
    function beforeFilter() {
        parent::beforeFilter();
        
        // have cookie and have session
        if(!$this->Session->check('User.id')) {
            $this->redirect(array('controller' => 'people', 'action' => 'challenge'));
        }
    }
    
    public function populate() {
        
//        $options = array('conditions' => array('Vote.user_id' => $this->Session->read('User.id')));
//        $votes = $this->Vote->find('all', $options);
//        $this->Session->write('Votes.all', $votes);
        
        $this->write_votes_to_session();
        $this->tally_votes_to_session();
        
        $this->redirect(array('controller' => 'users', 'action' => 'main'));
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
            $answer = $this->request->data('Vote.answer');
            $poll_id = $this->request->data('Vote.poll_id');
            
            // both values required and must not be empty
            if(!empty($answer) && !empty($poll_id)) {
                
                // sanitize - don't trust data
                $answer = filter_var($answer, FILTER_SANITIZE_STRING);
                $poll_id = intval($poll_id);
                $poll_id = filter_var($poll_id, FILTER_SANITIZE_NUMBER_INT);
                
                // check to see if they've already voted
                $options = array('conditions' => array('Vote.user_id' => $this->Session->read('User.id'), 'Vote.poll_id' => $poll_id));
                $vote = $this->Vote->find('first', $options);
                
                // TODO verify this is pulling the correct vote record
                
                // if we already have a hoody order
                if(isset($vote['Vote']['id'])) {
                    
                    $result = $this->update_vote($vote['Vote']['id'], $answer);
                    
                } else {
                    
                    $result = $this->new_vote($poll_id, $answer);
                    
                }
                
                if($result) {
                    $tally = $this->get_tally_votes_by_poll_id($poll_id);
                    
                    $this->output['tally'] = $tally;
                }
            }
        }
        
        $this->response->body(json_encode($this->output));
        $this->response->send();
        $this->_stop();
    }
    
    /**
    * Update a record for votes
    *
    * @param Required $id Int The id of the vote the user already voted on
    * @param Required $answer String The answer the user voted expecting either a or b
    * @return boolean true if the record was updated, false if not
    */
    private function update_vote($id, $answer) {
        
        $this->Vote->id = $id;
        
        if($this->Vote->saveField('answer', $answer)) {
            $votes = $this->write_votes_to_session();
            
            $this->output['response'] = true;
            $this->output['message'] = 'Successfully updated your vote.';
            $this->output['data'] = $votes;
            
            return true;
        }
        
        $this->output['response'] = false;
        $this->output['message'] = 'Unable to update your vote.';
        $this->output['data'] = array();

        return false;
    }
    
    /**
    * Create a new vote record for the a specific poll/user
    *
    * @param Required $poll_id Int The id of the poll associated with the vote
    * @param Required $answer String expecting a or b the answer they voted with
    * @return boolean true if the record was created, false if not
    */
    private function new_vote($poll_id, $answer) {
        
        $record = array(
            'Vote' => array(
                'user_id' => $this->Session->read('User.id'),
                'poll_id' => $poll_id,
                'answer' => $answer
            )
        );
        
        $this->Vote->create();

        if($this->Vote->save($record)) {
            $votes = $this->write_votes_to_session();
            
            $this->output['response'] = true;
            $this->output['message'] = 'Successfully created your vote.';
            $this->output['data'] = $votes;
            
            return true;
        }
        
        $this->output['response'] = false;
        $this->output['message'] = 'Unable to create your vote.';
        $this->output['data'] = $record;

        return false;
    }
    
    private function write_votes_to_session() {
        $options = array('conditions' => array('Vote.user_id' => $this->Session->read('User.id')));
        $votes = $this->Vote->find('all', $options);
        $this->Session->write('Votes.all', $votes);
        
        return $votes;
    }
    
    private function tally_votes_to_session() {
        
        $tally = array();
        
        $polls = $this->Session->read('Polls.all');
        
        foreach($polls as $poll) {
            $poll_id = $poll['polls']['id'];
            
            $tally_a = $this->query_votes_tally_by_answer($poll_id, 'a');
            $tally_b = $this->query_votes_tally_by_answer($poll_id, 'b');
            
            $tally[$poll_id] = array(
                'poll_id' => $poll_id,
                'tally_a' => $tally_a,
                'tally_b' => $tally_b
            );
        }
        
        $this->Session->write('Votes.tally', $tally);
        
        return $tally;
    }
    
    private function query_votes_tally_by_answer($poll_id, $answer) {
        $options = array(
            'conditions' => array('Vote.poll_id' => $poll_id, 'Vote.answer' => $answer)
        );

        return $this->Vote->find('count', $options);
    }
    
    private function get_tally_votes_by_poll_id($poll_id) {
        
        $poll_id = intval($poll_id);
        
        $tally = array();
            
        $tally_a = $this->query_votes_tally_by_answer($poll_id, 'a');
        $tally_b = $this->query_votes_tally_by_answer($poll_id, 'b');

        $tally[$poll_id] = array(
            'poll_id' => $poll_id,
            'tally_a' => $tally_a,
            'tally_b' => $tally_b
        );
//        $this->Session->write('Votes.tally', $tally);
        
        return $tally;
    }
}