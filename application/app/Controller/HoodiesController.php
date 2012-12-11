<?php
App::uses('AppController', 'Controller');
/**
 * Hoodies Controller
 *
 * @property Hoody $Hoody
 */
class HoodiesController extends AppController {

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
}
