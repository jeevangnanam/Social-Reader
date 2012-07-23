<?php
App::uses('AppController', 'Controller');
/**
 * Feedsocialsettings Controller
 *
 * @property Feedsocialsetting $Feedsocialsetting
 */
class FeedsocialsettingsController extends AppController {



 public function beforeFilter(){
		$this->Auth->allow('onoffsocial');
		
 }
/**
 * index method
 *
 * @return void
 
 */
	public function index() {

           
            
		$this->Feedsocialsetting->recursive = 0;
		$this->set('feedsocialsettings', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Feedsocialsetting->id = $id;
		if (!$this->Feedsocialsetting->exists()) {
			throw new NotFoundException(__('Invalid feedsocialsetting'));
		}
		$this->set('feedsocialsetting', $this->Feedsocialsetting->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Feedsocialsetting->create();
			if ($this->Feedsocialsetting->save($this->request->data)) {
				$this->Session->setFlash(__('The feedsocialsetting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedsocialsetting could not be saved. Please, try again.'));
			}
		}
		$feedrecords = $this->Feedsocialsetting->Feedrecord->find('list');
		$this->set(compact('feedrecords'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Feedsocialsetting->id = $id;
		if (!$this->Feedsocialsetting->exists()) {
			throw new NotFoundException(__('Invalid feedsocialsetting'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Feedsocialsetting->save($this->request->data)) {
				$this->Session->setFlash(__('The feedsocialsetting has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedsocialsetting could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Feedsocialsetting->read(null, $id);
		}
		$feedrecords = $this->Feedsocialsetting->Feedrecord->find('list');
		$this->set(compact('feedrecords'));
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
		$this->Feedsocialsetting->id = $id;
		if (!$this->Feedsocialsetting->exists()) {
			throw new NotFoundException(__('Invalid feedsocialsetting'));
		}
		if ($this->Feedsocialsetting->delete()) {
			$this->Session->setFlash(__('Feedsocialsetting deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Feedsocialsetting was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


       public function onOffSocial(){

           $user = $user = $this->Session->read('user');
           $feedrecord_id = $this->request->pass[0];
           $facebook_id= $user['id'];
     
            if(isset($feedrecord_id) and isset($facebook_id)){

                $this->layout = 'ajax';
                $this->autoRender = false;
           $this->RequestHandler->setContent('json', 'text/x-json');
             $statusCode = $this->Feedsocialsetting->checkSocialStatusOfFeedRecordOfUser($feedrecord_id,$facebook_id);

            $res =  $this->Feedsocialsetting->onOffSocial($statusCode,$feedrecord_id,$facebook_id);
         	 
            $this->set('socialOn',$res);
		
            return $res;
            }
           
            return false;
        }
}
