<?php
App::uses('AppModel', 'Model');
/**
 * Feedrecord Model
 *
 * @property Feed $Feed
 */
class Feedrecord extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'feed_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'link' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'feed_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	
	
	public function getFeedRecordsByUrl($url){
			
			
			$url = rawurldecode($url);
		
				$res  = $this->find('first',array('conditions' => array('link' => $url), 'fields' => array('id','title','description','link')));
			
			
                
                if(is_array($res)){
                        return $res; 
                }


                return false;
			}
			
			
			
		public function sendFacebookActivity($facebookObj,$action,$properties){
		
			if( isset($properties['image']) or !empty($properties['image'])){
				
				  $ret_obj = $facebookObj->api('/me/'.$action, 'post', array(
									'title' => $properties['title'],
									 'url'  => $properties['url'],
									 'image' => $properties['image']
								  ));
				  return $ret_obj['id'];
			}else{
				
				$ret_obj = $facebookObj->api('/me/'.$action, 'post', array(
									'title' => $properties['title'],
									 'url'  => $properties['url'],
								
								  ));
				  return $ret_obj['id'];
				
				}
		
		}
		
	/**
		
	* $urlOrId
	*
	*
	*
	*/
		public function sharev2($urlOrId){
			
			
			if(substr($urlOrId,0,4) == 'http'){
				//Url share is coming
				
					$feedrecords = $this->getFeedRecordsByUrl($urlOrId);
				
					  if($feedrecords != NULL){
						$feedrecords	=	$feedrecords['Feedrecord'];
						}
				}else{
				
				//Get the feedrecords from db	
					$feedrecords  = $this->find('first',array('conditions' => array('Feedrecord.id' => $urlOrId),'fields' => array('Feedrecord.id','title','description','link')));
					
			
						if($feedrecords != NULL){
						$feedrecords	=	$feedrecords['Feedrecord'];
						}
					
				}
				
				
		if(isset($feedrecords) and !empty($feedrecords)){
			
				App::import('Vendor', 'facebook/facebook');
		
				$config['appId'] = $appId;
				$config['secret'] = $secreat;
		
		
		
				$checkFacebook = true;
				$facebook = new Facebook($config);
				$user = $facebook->getUser();
				
						if ($user) {
								try {
				
				
									$user_profile = $facebook->api('/me');
									
									
									preg_match('#<img[^>]+src=[\'"]([^\'"]+)[\'"]#', $feedrecords['description'], $matches);
										if(count($matches)>1){
											$image = $matches[1];
										}
									$feedrecords['image'] = $image;
									$this->sendFacebookActivity($facebook,"adanews:preview",$feedrecords);
									
									
								}catch(FacebookApiException $e){
									
									
								}
							
						}
							
							
				}
		}
}


