<?php
App::uses('AppModel', 'Model');
/**
 * Facebookresponse Model
 *
 * @property Facebook $Facebook
 * @property Channel $Channel
 */
class Facebookresponse extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'response' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'facebook_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'channel_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'Feed' => array(
			'className' => 'Feed',
			'foreignKey' => 'feed_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(

		'Channel' => array(
			'className' => 'Channel',
			'foreignKey' => 'channel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Channel' => array(
			'className' => 'Channel',
			'foreignKey' => 'channel_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Feedrecord' => array(
			'className' => 'Feedrecord',
			'foreignKey' => 'feedrecord_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public  function addFacebookResponse($facebook_id,$channel_id,$response,$feed_id){

            if(isset($facebook_id) and isset($channel_id) and isset($response)){
            $data = array('Facebookresponse' => array(
				'response' => $response,
                'facebook_id' => $facebook_id,
                'channel_id'  => $channel_id,
				'feedrecord_id'  => $feed_id,
				'read' => date('Y-m-d h:m:s'),
				'status' => 1,
            ));
            return $this->save($data);
            }
            return false;
            
     }
	public function checkMaxSharingLimit($channelId,$facebook_id,$date){
			return $this->find('count',array(
			'conditions' => array('Facebookresponse.channel_id' => $channelId,'Facebookresponse.facebook_id' => $facebook_id,"date(Facebookresponse.read)" => $date)));
			
		}
	public function lastTenShares($id,$facebook_id){
		return $this->find('all',array('fileds'=>array('Facebookresponse.response','Facebookresponse.feed_id','Feedrecord.title'),'conditions'=>array('Facebookresponse.status'=>1,'Facebookresponse.facebook_id'=>$facebook_id,'Facebookresponse.channel_id'),'limit'=>10));
	}
	
	public  function deleteFacebookResponse($id){

            if(isset($id)){
            $data = array('Facebookresponse' => array(
				'id'=>$id,
				'status' => 0,
            ));
            return $this->save($data);
            }
            return false;
            
     }
}
