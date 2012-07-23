<?php
App::uses('AppController', 'Controller');
/**
 * Channelsettings Controller
 *
 * @property Channelsetting $Channelsetting
 */
class ChannelsettingsController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Channelsetting->recursive = 0;
		$this->set('channelsettings', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Channelsetting->id = $id;
		if (!$this->Channelsetting->exists()) {
			throw new NotFoundException(__('Invalid channelsetting'));
		}
		$this->set('channelsetting', $this->Channelsetting->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Channelsetting->create();
			if ($this->Channelsetting->save($this->request->data)) {
				$this->Session->setFlash(__('The channelsetting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channelsetting could not be saved. Please, try again.'));
			}
		}
		$channels = $this->Channelsetting->Channel->find('list');
		$this->set(compact('channels'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Channelsetting->id = $id;
		if (!$this->Channelsetting->exists()) {
			throw new NotFoundException(__('Invalid channelsetting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Channelsetting->save($this->request->data)) {
				$this->Session->setFlash(__('The channelsetting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channelsetting could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Channelsetting->read(null, $id);
		}
		$channels = $this->Channelsetting->Channel->find('list');
		$this->set(compact('channels'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Channelsetting->id = $id;
		if (!$this->Channelsetting->exists()) {
			throw new NotFoundException(__('Invalid channelsetting'));
		}
		if ($this->Channelsetting->delete()) {
			$this->Session->setFlash(__('Channelsetting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Channelsetting was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
