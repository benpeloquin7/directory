<?php
App::uses('AppController', 'Controller');
/**
 * Polls Controller
 *
 * @property Poll $Poll
 */
class PollsController extends AppController {
    
    public $components = array(
        'Session'
    );
    
    function beforeFilter() {
        parent::beforeFilter();
        
        if(!$this->Session->read('User.id')) {
            $this->redirect(array('controller' => 'users', 'action' => 'auth'));
        }
        
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Poll->recursive = 0;
		$this->set('polls', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Poll->exists($id)) {
			throw new NotFoundException(__('Invalid poll'));
		}
		$options = array('conditions' => array('Poll.' . $this->Poll->primaryKey => $id));
		$this->set('poll', $this->Poll->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Poll->create();
			if ($this->Poll->save($this->request->data)) {
				$this->Session->setFlash(__('The poll has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The poll could not be saved. Please, try again.'));
			}
		}
		$users = $this->Poll->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Poll->exists($id)) {
			throw new NotFoundException(__('Invalid poll'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Poll->save($this->request->data)) {
				$this->Session->setFlash(__('The poll has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The poll could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Poll.' . $this->Poll->primaryKey => $id));
			$this->request->data = $this->Poll->find('first', $options);
		}
		$users = $this->Poll->User->find('list');
		$this->set(compact('users'));
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
		$this->Poll->id = $id;
		if (!$this->Poll->exists()) {
			throw new NotFoundException(__('Invalid poll'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Poll->delete()) {
			$this->Session->setFlash(__('Poll deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Poll was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
/**
 * view the poll according to what poll has been completed
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function takePoll() {
            
            $this->layout = 'public';
            
            $current_poll_id = $this->getCurrentPoll();
            
            if($current_poll_id === false) {
                // TODO: show the last poll results without the vote action because
                // they've already voted
                
                $this->redirect(array('controller' => 'users', 'action' => 'listUsers'));
            }
            
            $this->updatePoll($current_poll_id);
            
            $this->Session->write('Poll.current', $current_poll_id);
            
            if (!$this->Poll->exists($current_poll_id)) {
                throw new NotFoundException(__('Invalid poll'));
            }
            
            $options = array('conditions' => array('Poll.' . $this->Poll->primaryKey => $current_poll_id));
            $this->set('poll', $this->Poll->find('first', $options));
            $this->set('session', $this->Session->read());
            
	}
        
/**
 * shows the users last poll if they have completed everything else
 *
 * @throws NotFoundException
 * @param string $poll_id
 * @return void
 */
        
        public function showLastPoll() {
            // get the last poll
            
            
        }

        
/**
 * get the most recent poll depending on the user
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function getCurrentPoll($last = false) {
            
            // get list of polls
            $polls = $this->Poll->find('all', array('fields' => array('Poll.id')));
            
            $poll_ids = array();
            
            foreach($polls as $poll) {
                $poll_ids[] = intval($poll['Poll']['id']);
            }
            
            // get list of polls voted on
            if($last) {
                $votes = $this->Poll->Vote->find('all', array('order' => array('Vote.poll_id' => 'ASC'), 'conditions' => array('Vote.user_id' => $this->Session->read('User.id'))));
            } else {
                $votes = $this->Poll->Vote->find('all', array('order' => array('Vote.poll_id' => 'DESC'), 'conditions' => array('Vote.user_id' => $this->Session->read('User.id'))));
            }
            
            if(empty($votes)) {
                return 1;
            }
            
            $vote_poll_ids = array();
            
            foreach($votes as $vote) {
                $vote_poll_ids[] = intval($vote['Vote']['poll_id']);
            }
            
            $stack = array();
            
            // find the differences in the array and index keys at "0"
            $stack = array_values(array_diff($poll_ids, $vote_poll_ids));
            
            if(empty($stack)) {
                return false;
            }
            
            return $stack[0];
            
	}
        
/**
 * Keep the poll up to date with the current vote count
 *
 * @throws NotFoundException
 * @param string $poll_id The ID of the poll to update
 * @return void
 */
	public function updatePoll($poll_id = 3) {
            
            if (!$this->Poll->exists($poll_id)) {
                throw new NotFoundException(__('Invalid poll'));
            }
            
            $poll = $this->Poll->find('first', array('conditions' => array('Poll.id' => $poll_id)));
            
            $tally_1 = $this->Poll->Vote->find('count', array('conditions' => array('Vote.poll_id' => $poll_id, 'Vote.answer' => 0)));
            $tally_2 = $this->Poll->Vote->find('count', array('conditions' => array('Vote.poll_id' => $poll_id, 'Vote.answer' => 1)));
            
            $poll['Poll']['tally_1'] = $tally_1;
            $poll['Poll']['tally_2'] = $tally_2;
            $this->Poll->create();
            $this->Poll->save($poll);
                
	}
       
}