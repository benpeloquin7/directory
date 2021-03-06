<?php
App::uses('AppController', 'Controller');
/**
 * Hoodies Controller
 *
 * @property Hoody $Hoody
 */
class HoodiesController extends AppController {
    
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
		$this->Hoody->recursive = 0;
		$this->set('hoodies', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Hoody->exists($id)) {
			throw new NotFoundException(__('Invalid hoody'));
		}
		$options = array('conditions' => array('Hoody.' . $this->Hoody->primaryKey => $id));
		$this->set('hoody', $this->Hoody->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Hoody->create();
			if ($this->Hoody->save($this->request->data)) {
				$this->Session->setFlash(__('The hoody has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The hoody could not be saved. Please, try again.'));
			}
		}
		$users = $this->Hoody->User->find('list');
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
		if (!$this->Hoody->exists($id)) {
			throw new NotFoundException(__('Invalid hoody'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Hoody->save($this->request->data)) {
				$this->Session->setFlash(__('The hoody has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The hoody could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Hoody.' . $this->Hoody->primaryKey => $id));
			$this->request->data = $this->Hoody->find('first', $options);
		}
		$users = $this->Hoody->User->find('list');
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
		$this->Hoody->id = $id;
		if (!$this->Hoody->exists()) {
			throw new NotFoundException(__('Invalid hoody'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Hoody->delete()) {
			$this->Session->setFlash(__('Hoody deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Hoody was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        
        
/**
 * Display the order form or redirect to the poll
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function orderForm () {
            
            // check to see if they've already done a hoodie
            $options = array('conditions' => array('Hoody.user_id' => $this->Session->read('User.id')));
            if(!$this->Hoody->find('first', $options)) {
                $this->layout = 'public';

                $this->set('title', 'GSP Partner App || Partner App');
                $this->set('userId', $this->Session->read('User.id'));
                $this->set('email', $this->Session->read('User.email'));
                $this->set('firstName', $this->Session->read('User.firstName'));
                $this->set('lastName', $this->Session->read('User.lastName'));
                $letter = strtolower(substr($this->Session->read('User.lastName'), 0, 1));
                $this->set('letter', $letter);
            } else {
                // redirect to the poll
                $this->redirect(array('controller' => 'votes', 'action' => 'checkVotes'));
            }
            
	}
        
        
/**
 * add the hoody to the db if it hasnt been added
 *
 * @return void
 */
	public function addHoody() {
            
            $this->response->type('json');
            $url = Router::url(array('controller' => 'hoodies', 'action' => 'orderForm'));
            $response = array('response' => false, 'redirect' => $url);
            
            if ($this->request->is('post')) {
                $this->Hoody->create();
                if ($this->Hoody->save($this->request->data)) {
                    $url = Router::url(array('controller' => 'votes', 'action' => 'checkVotes'));
                    $response = array('response' => true, 'redirect' => $url);
                }
            }
            
            $this->response->body(json_encode($response));
            $this->response->send();
            
	}
        
}
