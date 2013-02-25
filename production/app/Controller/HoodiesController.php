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
    
    function beforeFilter() {
        parent::beforeFilter();
        
        // have cookie and have session
        if(!$this->Session->check('User.id')) {
            $this->redirect(array('controller' => 'bouncer', 'action' => 'challenge'));
        }
    }
    
    public function populate() {
        $options = array('conditions' => array('Hoody.user_id' => $this->Session->read('User.id')));
        $this->Session->write($this->Hoody->find('first', $options));
        
        $this->redirect(array('controller' => 'polls', 'action' => 'populate'));
    }
}