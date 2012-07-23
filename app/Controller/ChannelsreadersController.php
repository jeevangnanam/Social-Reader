<?php
App::uses('AppController', 'Controller');
/**
 * ChannelsReaders Controller
 *
 * @property ChannelsReader $ChannelsReader
 */
class ChannelsReadersController extends AppController {



/**
 * admin_index method
 *
 * @return void
 */
	public function index() {
		
	}
	
	public function onOffGlobalSocialStatus(){
		   $this->autoRender = false;
		$user = $this->Session->read('user');
	
		$channelId =	$this->request->pass[0];
		
	
		if(is_array($user) and isset($channelId)){
			
           return $this->ChannelsReader->OnOffSocialForChannel($user['id'],$channelId);
            
		}
		return false;
		
		}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->ChannelsReader->id = $id;
		if (!$this->ChannelsReader->exists()) {
			throw new NotFoundException(__('Invalid channels reader'));
		}
		$this->set('channelsReader', $this->ChannelsReader->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->ChannelsReader->create();
			if ($this->ChannelsReader->save($this->request->data)) {
				$this->Session->setFlash(__('The channels reader has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The channels reader could not be saved. Please, try again.'));
			}
		}
//		$readers = $this->ChannelsReader->Reader->find('list',array('fields' =>array('first_name' , 'last_name' ,'facebook_id')));
//
//		$channels = $this->ChannelsReader->Channel->find('list');
//		$this->set(compact('readers', 'channels'));
	}

}
