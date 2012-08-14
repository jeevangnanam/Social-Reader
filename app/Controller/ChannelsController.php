<?php

/**
 * Comments Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ChannelsController extends AppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Channels';
    /**
     * Helpers
     */
    var $helpers = array('Cache');
    var $cacheAction = array(
        'index/' => '60000'
    );
	
    /**
     * Components
     *
     * @var array
     * @access public
     */
    public $components = array(
        'Akismet',
        'Email',
        'Recaptcha',
    );
    /**
     * Models used by the Controller
     *
     * @var array
     * @access public
     */
    public $uses = array('Channel', 'Reader', 'Feed', 'Feedrecord', 'ChannelsReader','Facebookresponse');
	
    /**
     * beforeFilter
     *
     * @return void
     * @access public
     */
    public function beforeFilter() {
        $this->Auth->allow('index','chaeckLikes');

        $this->Security->validatePost = false;
        $this->Security->csrfCheck = false;
        $this->set('title_for_layout', 'Daily mirror social reader');
        $this->layout = 'dailymirror';
    }

    /**
     *  index
     *
     * @return void
     * @access public
     */
    public function index() {

        $this->cacheAction = true;
		$fanpage_id="";

		//import necessory models
		//@TODO Find a suitable solution
		
		App::import('Model', 'ChannelsReader');
		$ChannelsReader = new ChannelsReader();
				
		App::import('Model', 'Facebookresponse');
		$Facebookresponse = new Facebookresponse();
		//debug($Facebookresponse->lastTenShares()); 	
        if (!isset($this->request->pass[0])) {
            $this->log("Channel id is empty", 'debug');
            die('Channel id can not be empty');
        }


        if (isset($this->request->pass[1])) {

            $feedCategory = $this->request->pass[1];
            $this->set('feedCategory', $feedCategory);
        }

        $channelId = $this->request->pass[0];

        $channelDetails = $this->Channel->findById($channelId);
	
        $channelDetails = $channelDetails['Channel'];
        $this->Session->write('channelDetails', $channelDetails);

        $appId = $channelDetails['app_id'];
        $secreat = $channelDetails['app_secreate'];
        $channel = $channelDetails;

        $this->set('appId', $appId);


        if ($channelDetails['layout'] == '' or is_null($channelDetails['layout']) or empty($channelDetails['layout'])) {

            $layout = 'default';
        } else {

            $layout = $channelDetails['layout'];
        }

        $facebookAppProperties = json_decode(file_get_contents("https://graph.facebook.com/" . $appId));
		
        $this->Session->write('facebookAppProperties', $facebookAppProperties);

        if ($channelDetails['applogo'] == '' or is_null($channelDetails['applogo']) or empty($channelDetails['applogo'])) {
            $facebookAppLog = $this->Session->read('facebookAppProperties');
            if (!is_null($facebookAppLog)) {
                $this->set('appLogo', $facebookAppLog->logo_url);
            }
        } else {

            $this->set('appLogo', "/appproperties/" . $channelDetails['name'] . "/img/" . $channelDetails['applogo']);
        }


        $this->layout = $layout;

        #Facebook stuff
        App::import('Vendor', 'facebook/facebook');

        $config['appId'] = $appId;
        $config['secret'] = $secreat;



        $checkFacebook = true;
        $facebook = new Facebook($config);
        $user = $facebook->getUser();



        if ($checkFacebook) {
            if ($user) {
                try {


                    $user_profile = $facebook->api('/me');

                    $this->Session->write('user', $user_profile);
                    //Adding channel id
                    
                    //Adding marital status
                    $user_profile['marital_status'] = '';

                    $this->Reader->saveReader($user_profile);

                    if (!$ChannelsReader->checkReaderExists($user_profile['id'], $channelId)) {
                        $ChannelsReader->addReader($user_profile['id'], $channelId);
                    }

                   




                   
                } catch (FacebookApiException $e) {
                    error_log($e);
                    $user = null;
                    //header( 'Location: http://apps.facebook.com/brush_dance_' );
                }
            } else {
                $loginUrl = $facebook->getLoginUrl();
                //echo "<a href='$loginUrl'>login</a>";

                $url = $loginUrl;

                $QUERYVAR = parse_url($url, PHP_URL_QUERY);

                $GETVARS = explode('&', $QUERYVAR);

                foreach ($GETVARS as $string) {
                    list($is, $what) = explode('=', $string);
                    //echo "$is -> $what<br/>";
                    if ($is == 'state') {
                        $state = $what;
                    }
                }
                echo "<script>top.location.href='" . $facebook->getLoginUrl() . "';</script>";
            }
        }

		if(!isset($user_profile)){
			
				$sessionUserDetails = $this->Session->read('user');
				if(isset($sessionUserDetails)){
					$user_profile = $this->Session->read('user');
					}
			}
        //Facebook stuff ends
		
        //Load the feed details
		$fanpage_id=$this->Channel->getFanPage($channelId);
		$fanpage_id=$fanpage_id[0]['Channel']['fanpage_id'];
		$lk=$facebook->api('/me/likes/'.$fanpage_id);
		
		$likes = count($lk['data']);
		
        $this->Feed->recursive = -1;
        $feedList = $this->Feed->find('all', array('conditions' => array('Feed.status' => '1', 'channel_id' => $channelId)));

        $counter = 0;
        foreach ($feedList as $feed) {
            ++$counter;
            $feedForView[$counter]['feedtitle'] = $feed['Feed']['name'];
            $feedForView[$counter]['feedId'] = $feed['Feed']['id'];

            $this->Feedrecord->recursive = -1;
            $feedRecords = $this->Feedrecord->find('all', array('conditions' => array('feed_id' => $feed['Feed']['id']),'order'=>array('Feedrecord.id'=>'DESC'),'limit' => 10));
            $feedForView[$counter]['records'] = $feedRecords;
        }

        $feedNames = $this->_giveFeedNames($feedList);

				

        $globalSocialStatusForThisApp = $ChannelsReader->checkCurrentSocialStatusForChannel($user_profile['id'],$channelId);
        $globalShareLimitForTheChannel = $ChannelsReader->readCurrentPostShareLimit($user_profile['id'],$channelId);
	
		$layout = (isset($channelDetails['layout']) or ( !empty($channelDetails['layout'])))?$channelDetails['layout']: 'default';


        # Menu
        $this->set('menu', $feedNames);

        # FOR LAYOUT
        if (isset($channel) and is_array($channel)) {


            Configure::write('Site.title', $channel['appname']);
            Configure::write('Site.tagline', $channel['appdescription']);
        }
		
		
		// get the app users 
		$channel_readers=$this->ChannelsReader->getAppInstalledUsers($channelId);
		$arrayChannelReaders= array();
		foreach($channel_readers as $channel_reader){
			$arrayChannelReaders[]=$channel_reader['ChannelsReader']['facebook_id'];
		}
		// End get app users
		
		//Get appusers from facebook
		
		$friendReaders = $facebook->api('/me/friends?fields=installed');
		
		   foreach($friendReaders['data'] as $friendReader){
			   
			   if(isset($friendReader['installed'])){
			   $appUsersFriends[] = $friendReader['id'];
			   }
			   }
		
	
		
		
		
		$facebook_id=$facebook->api('/me');
		$recentShares=$Facebookresponse->lastTenShares($channelId,$facebook_id['id']);
		//debug($recentShares);
		//die();
        # For view
		
		$this->set('channelId',$channelId);
        $this->set('feedForView', $feedForView);
        $this->set('globalSocialStatusForThisApp', $globalSocialStatusForThisApp);
		$this->set('layout',$layout);
        $this->set('globalShareLimitForTheChannel' ,$globalShareLimitForTheChannel);
		$this->set('userProfile', $user_profile);
		$this->set('likes',$likes);
		$this->set('appUsers',$facebookAppProperties->monthly_active_users);
		$this->set('appUsersFriends',$appUsersFriends);
		$this->set('recentShares',$recentShares);/**/
    }

    function _giveFeedNames($feedList) {

        if (isset($feedList) and $feedList != '') {

            $counter = 0;
            foreach ($feedList as $feed) {
                $counter++;
                $feedNames[$counter]['FeedName'] = $feed['Feed']['name'];
                $feedNames[$counter]['FeedId'] = $feed['Feed']['id'];
            }
            return $feedNames;
        }
        return null;
    }
	
	function chaecklikes($pageid=NULL,$channelId=NULL){
		$this->layout="ajax";
		$channelId=$this->params['pass'][0];
		$fanpage_id=$this->Channel->getFanPage($channelId);
		$pageid=$fanpage_id[0]['Channel']['fanpage_id'];
		$graph = json_decode(file_get_contents("https://graph.facebook.com/".$pageid));
		$this->set("name",$fanpage_id[0]['Channel']['appname']);
		$this->set("graph",$graph);
	}
}
