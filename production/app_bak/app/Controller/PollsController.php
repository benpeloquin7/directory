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

class PollsController extends AppController {

    public $name = 'Polls';
        
    public $components = array('Cookie', 'Session');
    
    function beforeFilter() {
        parent::beforeFilter();
        
        // have cookie and have session
        if(!$this->Session->check('User.id')) {
            $this->redirect(array('controller' => 'people', 'action' => 'challenge'));
        }
    }
    
    public function populate() {
        
//        $data = $this->Poll->find('all');
        $data = $this->Poll->query("SELECT * FROM polls;");
        
        $this->Session->write('Polls.all', $data);
        
        $this->redirect(array('controller' => 'votes', 'action' => 'populate'));
    }
}