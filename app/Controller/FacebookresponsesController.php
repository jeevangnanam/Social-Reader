<?php
App::uses('AppController', 'Controller');
/**
 * Facebookresponses Controller
 *
 */
class FacebookresponsesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
	public $uses = array('Facebookresponse','Reader','Feedrecord','Feedsocialsetting','Channel','ChannelsReader');
    var $ChannelsReader;
    
	 public function beforeFilter() {
        $this->Auth->allow('saveresponses');
		$this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
		
        App::import('Model', 'ChannelsReader');
		$this->ChannelsReader = new ChannelsReader();
        parent::beforeFilter();
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Facebookresponse->recursive = 0;
		$this->set('facebookresponse', $this->paginate());
	}
	
	public function saveresponses(){
		 $this->layout = 'ajax';
		$this->autoRender = false;
        $user = $this->Session->read('user');
		
        $channelId =	$_POST['channel'];
		$response =	$_POST['response'];
		$channelDetails = $this->Session->read('channelDetails');
			if(!isset($channelDetails) or empty($channelDetails)) {
                           $res = $this->Feedrecord->find('all',array('conditions' => array('Feedrecord.id' => $id)));
				 $channelDetails= ($res[0]['Feed']['Channel']);
			 }
		$channelId=$channelDetails['id'];
		$this->Facebookresponse->addFacebookResponse($user['id'], $channelId,$response);
	}
	
	
}
