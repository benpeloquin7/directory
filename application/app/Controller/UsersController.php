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
        
        // if we have a cookie but we don't have a session
        if($this->Cookie->check('GSPPartnerAppUser') && !$this->Session->check('User.email')) {
            $checkAgainstDb = $this->Cookie->read('GSPPartnerAppUser');
            $options = array('conditions' => array('User.email' => $checkAgainstDb['email']));
            $result = $this->User->find('first', $options);
            
            if($result) {
                $nameArr = $this->parseEmailForName($result['User']['email']);
                
                $this->Session->write('User.id', $result['User']['id']);
                $this->Session->write('User.email', $result['User']['email']);
                $this->Session->write('User.firstName', $nameArr[0]);
                $this->Session->write('User.lastName', $nameArr[1]);
            }
        }
        
        if(!$this->Cookie->check('GSPPartnerAppUser') && $this->Session->check('User.email')) {
            $this->Session->delete('User');
        }
    }
    
/**
 * authenticate new users
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function auth() {
            
//            $this->autoRender = false;
            
            $this->layout = 'auth';
            $this->set('title', 'GSP Partner App || Login');
            
//            if($this->Cookie->check('GSPPartnerAppUser')) {
//                // get the value, 
//                $checkAgainstDb = $this->Cookie->read('GSPPartnerAppUser');
//                
////                Debugger::dump($checkAgainstDb);
//                
//                // check the database for completion of things
//                $options = array('conditions' => array('User.email' => $checkAgainstDb['email']));
//                $result = $this->User->find('first', $options);
//                
////                Debugger::dump($result);
//                
//                // redirect to whatever they havent completed or to the directory listing
//                if($result) {
//                    $this->set('email', $result['User']['email']);
//                    $this->render();
//                } else {
//                    $this->set('email', '');
//                    $this->render();
//                }
//            } else {
//                
//                $this->set('email', '');
//                $this->render();
//            }
            
            $this->set('email', $this->Session->read('User.email'));
            
//            $this->render();
            
	}
        
/**
 * authenticate new users
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function login() {
//            
//            $this->autoRender = false;
//            
//            if ($this->request->is('post')) {
//                
//                $this->response->type('json');
//                
//                // query db for email - if email in db, then the next part is true
//            
//                if(in_array('mike_newell@gspsf.com', $this->request->data)) {
//                    $arr = array('response' => true, 'formData' => $this->request->data);
//                    $this->response->body(json_encode($arr));
//                } else {
//                    $arr = array('response' => false, 'formData' => $this->request->data);
//                    $this->response->body(json_encode($arr));
//                }
//                
//                $this->response->send();
//                
//            }
//	}
        
        public function login() {
            
            $this->autoRender = false;
            
            if ($this->request->is('post')) {
                
                $options = array('conditions' => array('User.email' => $this->request->data('User')));
                $result = $this->User->find('first', $options);
                
//                Debugger::dump($result);
                
                if($result) {
                    
                    // parse email for name
                    $nameArr = $this->parseEmailForName($result['User']['email']);
                    
                    // set cookie
                    $this->Cookie->write('GSPPartnerAppUser',
                        array('email' => $result['User']['email'], 'firstName' => $nameArr[0], 'lastName' => $nameArr[1]),
                        false,
                        604800
                    );
                    
                    // set session
                    $this->Session->write('User.id', $result['User']['id']);
                    $this->Session->write('User.email', $result['User']['email']);
                    $this->Session->write('User.firstName', $nameArr[0]);
                    $this->Session->write('User.lastName', $nameArr[1]);
                    
                    // redirect
                    $this->redirect(array('controller' => 'hoodies', 'action' => 'orderForm'));
                } else {
                    // redirect with a flash message that says you suck
                    $this->redirect(array('controller' => 'users', 'action' => 'auth'));
                }
                
            }
	}
    
/**
 * mob method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
//	public function hoodie() {
//            
//            
//            
//            $this->layout = 'public';
//            $this->set('title', 'GSP Partner App || Partner App');
//            
//            $userArr = array(
//                                'email' => $this->Session->read('User.email'),
//                                'firstName' => $this->Session->read('User.firstName'),
//                                'lastName' => $this->Session->read('User.lastName')
//                            );
//            $this->set('userInfo', $userArr);
//            // shows the directory app to anyone
//	}

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
        
/**
 * Convenience method for parsing the name
 *
 * @param string $email
 * @return array $names
 */
        private function parseEmailForName($e) {
            
            $e = str_replace('@gspsf.com', '', $e);
            
            $arr = explode('_', $e);
            
            $firstName = ucfirst($arr[0]);
            $lastName = ucfirst($arr[1]);
            
            return array($firstName, $lastName);
        }
        
/**
 * Convenience method for parsing the name
 *
 * @param string $email
 * @return array $names
 */
        public function listUsers() {
            $this->layout = 'public';
        }
        
}

