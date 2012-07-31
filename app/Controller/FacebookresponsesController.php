<?php
App::uses('AppController', 'Controller');
/**
 * Facebookresponses Controller
 *
 */
class FacebookresponsesController extends AppController {
 /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Facebookresponses';
    /**
     * Helpers
     */
    var $helpers = array('Cache');
    var $cacheAction = array(
        'index/' => '60000'
    );
	
    public $components = array(
        'Akismet',
        'Email',
        'Recaptcha',
    );

     public $uses = array('Channel', 'Reader', 'Feed', 'Feedrecord', 'ChannelsReader','Facebookresponse');
    
	 public function beforeFilter() {
        $this->Auth->allow('saveresponses','daleteresponses');
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
		
        $channelId = $_POST['channel'];
		$feed_id   = $channelId;
		
		$response =	$_POST['response'];
		$channelDetails = $this->Session->read('channelDetails');
			if(!isset($channelDetails) or empty($channelDetails)) {
                           $res = $this->Feedrecord->find('all',array('conditions' => array('Feedrecord.id' => $id)));
				 $channelDetails= ($res[0]['Feed']['Channel']);
			 }
		$channelId=$channelDetails['id'];
		$this->Facebookresponse->addFacebookResponse($user['id'], $channelId,$response,$feed_id);
	}
	public function daleteresponses($response_id=NULL){
		 $this->layout = 'ajax';
		$this->autoRender = false;
		$response_id=$this->params['pass'][0];
		$id=$this->Facebookresponse->find('list',array('conditions'=>array('Facebookresponse.response'=>$response_id)));
		
		$this->Facebookresponse->delete($id);
	}
	
	
}
