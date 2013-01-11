<?php
App::uses('AppController', 'Controller');
/**
 * Votes Controller
 *
 * @property Vote $Vote
 */
class VotesController extends AppController {
    
    public $components = array(
        'Session'
    );
    
    function beforeFilter() {
        parent::beforeFilter();
        
        if(!$this->Session->read('User.id')) {
            $this->redirect(array('controller' => 'users', 'action' => 'auth'));
        }
        
        $options = array('conditions' => array('Vote.user_id' => $this->Session->read('User.id')));
        $votes = $this->Vote->find('first', $options);
        
        $this->Session->write('Votes.votes', $votes);
        
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Vote->recursive = 0;
		$this->set('votes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
		$this->set('vote', $this->Vote->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Vote->create();
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
			}
		}
		$polls = $this->Vote->Poll->find('list');
		$users = $this->Vote->User->find('list');
		$this->set(compact('polls', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Vote->exists($id)) {
			throw new NotFoundException(__('Invalid vote'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Vote->save($this->request->data)) {
				$this->Session->setFlash(__('The vote has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vote could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vote.' . $this->Vote->primaryKey => $id));
			$this->request->data = $this->Vote->find('first', $options);
		}
		$polls = $this->Vote->Poll->find('list');
		$users = $this->Vote->User->find('list');
		$this->set(compact('polls', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Vote->id = $id;
		if (!$this->Vote->exists()) {
			throw new NotFoundException(__('Invalid vote'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Vote->delete()) {
			$this->Session->setFlash(__('Vote deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Vote was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * determine which votes have been completed
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function checkVotes() {
            
//            $this->autoRender = false;
            $this->layout = false;
            $this->render(false);
            
            if($this->Session->read('User.id')) {
                
                $this->redirect(array('controller' => 'polls', 'action' => 'takePoll'));
                
//                $options = array('conditions' => array('Vote.user_id' => $this->Session->read('User.id')));
//                $votes = $this->Vote->find('first', $options);
                
//                if(empty($votes)) {
//                    // no entries = they havent completed a poll
//                    $poll = $this->Vote->Poll->find('first');
//                    $this->Session->write('Poll.current', $poll['Poll']['id']);
//                    $this->redirect(array('controller' => 'polls', 'action' => 'takePoll'));
//                }
                
                // do some logic here to find out what polls they've completed
//                Debugger::dump($votes);
//                Debugger::dump($options);
//                Debugger::dump($poll);
            }
	}
}
