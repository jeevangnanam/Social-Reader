<?php
App::uses('AppController', 'Controller');
/**
 * ChannelsReaders Controller
 *
 * @property ChannelsReader $ChannelsReader
 */
class ChannelsReadersController extends AppController {

 	var $components = array('RequestHandler');

    function  beforeFilter() {
        parent::beforeFilter();

		$this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        $this->Auth->allow(array('setNewShareLimit','onOffGlobalSocialStatus','getCurrentPostShareLimit','checkCurrentSocialStatusForChannel'));
    }

/**
 * admin_index method
 *
 * @return void
 */
	public function index() {
		
	}


        public function setNewShareLimit(){
        $this->autoRender = false;
            $user = $this->Session->read('user');
            $channelId =	$this->request->pass[0];
            $limit =	$this->request->pass[1];

            if($this->ChannelsReader->checkReaderExists($user['id'],$channelId) == false){

                $this->ChannelsReader->addReader($user['id'], $channelId);
            }
            
            $this->ChannelsReader->setCurrentPostShareLimit($user['id'],$channelId,$limit);
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



        public function getCurrentPostShareLimit(){

                $user = $this->Session->read('user');

		$channelId =	$this->request->pass[0];

                return $this->ChannelsReader->readCurrentPostShareLimit($user['id'],$channelId);


        }
		
		public function checkCurrentSocialStatusForChannel(){
			$this->autoRender =  false;
			
			    $facebookId = isset($_POST['user'])?trim($_POST['user']): NULL;
				$channelId = isset($_POST['channel'])?trim($_POST['channel']): NULL;
				if(isset($facebookId) && isset($channelId)){
			
					if($this->RequestHandler->isAjax()){
						
						return   json_encode($this->ChannelsReader->checkCurrentSocialStatusForChannel($facebookId, $channelId));
					}
					
					 return $this->ChannelsReader->checkCurrentSocialStatusForChannel($facebookId, $channelId);
					 
				}
				
				return false;
			}


}
