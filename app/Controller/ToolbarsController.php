<?php
App::uses('AppController', 'Controller');
/**
 * Feedrecords Controller
 *
 * @property Feedrecord $Feedrecord
 */
class ToolbarsController extends AppController {


			var $uses =  array('Channel');
			
			 public function beforeFilter(){

        			 parent::beforeFilter();
					 $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
		 			$this->Auth->allow('index','iframe');
     		}
			
			
			
			function index(){
				
				$this->layout = 'toolbars';
				
				}
			
			function iframe(){
				
				App::import('Model', 'ChannelsReader');
		$ChannelsReader = new ChannelsReader();
		
		
				$this->layout = 'toolbars';
				$channelId = $this->request->pass[0];
				$channelDetails = $this->Channel->findById($channelId);
				$this->set('channelId',$this->request->pass[0]);
				$this->set('channelName',$channelDetails['Channel']['name']);
				$this->set('canvas_url',$channelDetails['Channel']['canvas_url']);
				
				//$this->set('debug' , $user_profile['id']." - ".$channelId);
				
				#Facebook stuff
        App::import('Vendor', 'facebook/facebook');

        $config['appId'] = $channelDetails['Channel']['app_id'];
        $config['secret'] = $channelDetails['Channel']['app_secreate'];

        $checkFacebook = true;
        $facebook = new Facebook($config);
        $user = $facebook->getUser();

        if ($checkFacebook) {
            if ($user) {
                try {


                    $user_profile = $facebook->api('/me');
					$this->set('id',$user_profile['id']);
					$globalSocialStatusForThisApp = $ChannelsReader->checkCurrentSocialStatusForChannel($user_profile['id'],$channelId);
					$this->set('globalSocialStatusForThisApp',$globalSocialStatusForThisApp);
		
				}catch (FacebookApiException $e) {
                    error_log($e);
                    $user = null;
                    //header( 'Location: http://apps.facebook.com/brush_dance_' );
                }
			}else{
				
				$this->set('facebook_installed', 'no');
				}
		}
		
		
			}
			
			
			

}
