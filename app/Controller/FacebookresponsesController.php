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
		$feedRecord="";
		$channelDetails = $this->Session->read('channelDetails');
			if(!isset($channelDetails) or empty($channelDetails)) {
                           $res = $this->Feedrecord->find('all',array('conditions' => array('Feedrecord.id' => $id)));
				 $channelDetails= ($res[0]['Feed']['Channel']);
				 $feedRecord = ($res[0]['Feedrecord']['title']);
			 }
		$channelId=$channelDetails['id'];
		
		$sres=$this->Facebookresponse->addFacebookResponse($user['id'], $channelId,$response,$feed_id);
		
		if($sres){
			echo "<li id=\"".$response."_li\"> $feedRecord <img id=\"". $response ."\" class=\"removepost\" alt=\"\" src=\"/img/remove-share-button.jpg\"></li>";
		}
	}
	public function daleteresponses($response_id=NULL){
		 $this->layout = 'ajax';
		$this->autoRender = false;
		$response_id=$this->params['pass'][0];
		$id=$this->Facebookresponse->find('list',array('conditions'=>array('Facebookresponse.response'=>$response_id)));
		$fResId;
		foreach($id as $rId){
			$fResId=$rId;
		} 

		$this->request->data['Facebookresponse']['id']=$fResId;
		$this->request->data['Facebookresponse']['status']= 0;
		 if(isset($id)){
			 
         $data=$this->request->data;

			if($this->Facebookresponse->save($data)){
				return true;
			}
			else{
				return false;
			}
         }
		 else{
            return false;
		 }
		
	}
	
	
}
