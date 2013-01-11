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
            
            Debugger::dump($this->Session->read());
            
            if(!$this->Session->read('Poll.current')) {
                $current_poll_id = $this->getCurrentPoll();
                
                Debugger::dump($current_poll_id);
                
                $this->Session->write('Poll.current', $current_poll_id);
            }
            
            Debugger::dump($this->Session->read());
            
//            $id = $this->Session->read('Poll.current');
//            
//            if (!$this->Poll->exists($id)) {
//                    throw new NotFoundException(__('Invalid poll'));
//            }
//            
//            $options = array('conditions' => array('Poll.' . $this->Poll->primaryKey => $id));
//            $this->set('poll', $this->Poll->find('first', $options));
	}
        
/**
 * get the most recent poll depending on the user
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function getCurrentPoll() {
            
            $this->layout = false;
            $this->render(false);
            
            if($this->Session->read('User.id')) {
                

                $polls = $this->Poll->find('all', array('fields' => array('Poll.id')));
                $votes = $this->Poll->Vote->find('list', array(
                    'fields' => array('Vote.poll_id', 'Vote.user_id'),
                    'conditions' => array('Vote.user_id' => $this->Session->read('User.id'))
                ));
                
//                if(empty($votes)) {
//                    // we've not voted
//                    return $polls;
//                }

                return array($polls, $votes);
            } else {
                return 1;
//                $this->redirect(array('controller' => 'users', 'action' => 'auth'));
            }
            
                
	}
       
}
