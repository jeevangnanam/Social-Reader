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
        $this->Auth->allow('saveresponses','daleteresponses','getLastTenShares');
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
		
        $channelId = trim($_POST['channel']);
		$userId = trim($_POST['user']);
		$response = trim($_POST['response']);
		$url 	 = trim($_POST['url']);
	
		

		
		$sres=$this->Facebookresponse->addFacebookResponse($userId, $channelId,$response,$url);
		
		if($sres){
			echo true;
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
	
	
	
	public function getLastTenShares(){
		//Configure::write('debug', 2);
		    $this->autoRender = false;
			
			if(isset($_POST['userId']) and isset($_POST['channelId'])){
				
				$shares = $this->Facebookresponse->lastTenShares(trim($_POST['channelId']),trim($_POST['userId']));
				
				if(is_array($shares) and count($shares)>0){
					
					foreach($shares as $share){
						
						$styledShare[] = "<li id=".$share['response']."_li>".$share['title']." <img src='/img/icons/close.jpg' rel='".$share['response']."' id='removeShare' title='Remove social graph activity' style='cursor:pointer'/></li>";
						
						}
					return json_encode($styledShare);
					}
			
			}
			return false;
		}
	
}
