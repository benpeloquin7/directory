<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
    
    // Pass settings in $components array
    public $components = array(
//        'Auth' => array(
//            'loginAction' => array(
//                'controller' => 'users',
//                'action' => 'login'
//            ),
//            'authError' => 'Did you really think you are allowed to see that?',
//            'authenticate' => array(
//                'Form' => array(
//                    'fields' => array('username' => 'email')
//                )
//            )
//        ),
        'Cookie',
        'Session'
    );
    
    function beforeFilter() {
        parent::beforeFilter();
        
//        $this->Auth->authenticate = array('Form');
    }
    
/**
 * authenticate new users
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function auth() {
            if($this->Cookie->check('GSPPartnerAppUser')) {
                // get the value, 
                // check the database for completion of things
                // redirect to whatever they havent completed or to the directory listing
            } else {
                $this->layout = 'auth';
                $this->set('title', 'GSP Partner App || Partner App');
            }
	}
        
/**
 * authenticate new users
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function login() {
            
            $this->autoRender = false;
            
            if ($this->request->is('post')) {
                // check the form data
//                if () {
//                    return $this->redirect($this->Auth->redirect());
//                } else {
//                    $this->Session->setFlash(__('Username or password is incorrect'), 'default', array(), 'auth');
//                }
            }
	}
    
/**
 * mob method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function hoodie() {
            $this->layout = 'public';
            $this->set('title', 'GSP Partner App || Partner App');
            // shows the directory app to anyone
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
}
