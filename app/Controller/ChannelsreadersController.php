<?php
App::uses('AppController', 'Controller');
/**
 * ChannelsReaders Controller
 *
 * @property ChannelsReader $ChannelsReader
 */
class ChannelsReadersController extends AppController {



    function  beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow(array('setNewShareLimit','onOffGlobalSocialStatus','getCurrentPostShareLimit'));
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


}
