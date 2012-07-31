<?php
App::uses('AppModel', 'Model');
/**
 * ChannelsReader Model
 *
 * @property Facebook $Facebook
 * @property Channel $Channel
 */
class ChannelsReader extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'facebook_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'socialon' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'isuninstalled' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),

                'maxshareperday' => array(
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
		'Reader' => array(
			'className' => 'Reader',
			'foreignKey' => 'facebook_id',
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
		)
	);


        function checkReaderExists($facebook_id,$channel_id){
            if(isset($facebook_id) and isset($channel_id)){
            $this->recursive = -1;
            $readers = $this->find('first',array('conditions' => array('ChannelsReader.facebook_id' => $facebook_id, 'channel_id' => $channel_id)));

            if(is_array($readers)){
                return true;
            }else{
                return false;
            }
            }

            return false;
        }

        function addReader($facebook_id,$channel_id){

            if(isset($facebook_id) and isset($channel_id)){
            $data = array('ChannelsReader' => array(

                'facebook_id' => $facebook_id,
                'channel_id'  => $channel_id,

            ));
            return $this->save($data);
            }
            return false;
            
        }

       public function checkCurrentSocialStatusForChannel($facebook_id,$channel_id){
		
             $this->recursive = -1;
            if(isset($facebook_id) and isset($channel_id)){
                
                 $readers = $this->find('first',array('conditions' => array('ChannelsReader.facebook_id' => $facebook_id, 'channel_id' => $channel_id)));
               
                    if($readers != false and is_array($readers)){

                        if($readers['ChannelsReader']['socialon'] == 0){

                            return false;
                        }else{

                            return true;
                        }
                    }
            }
            return false;
        }

        function onSocialForChannel($facebook_id,$channel_id){

            if(isset($facebook_id) and isset($channel_id)){

                    if($this->updateAll(array('socialon' => '1'), array('ChannelsReader.facebook_id' => $facebook_id , 'channel_id' => $channel_id))){
                        return true;
                    }
            }
            return false;
        }

        function OffSocialForChannel($facebook_id,$channel_id){

            if(isset($facebook_id) and isset($channel_id)){
                    if($this->updateAll(array('socialon' => '0'), array('ChannelsReader.facebook_id' => $facebook_id , 'channel_id' => $channel_id))){
                        return true;
                    }
                
            }
            return false;
        }

        function OnOffSocialForChannel($facebook_id,$channel_id){

               if(isset($facebook_id) and isset($channel_id)){
                    $socialon = 0;
                    $status = $this->checkCurrentSocialStatusForChannel($facebook_id,$channel_id);
                    if($status == true){
                        $socialon = 0;
                    }else{
                        $socialon = 1;
                    }
                     if($this->updateAll(array('socialon' => $socialon), array('ChannelsReader.facebook_id' => $facebook_id , 'channel_id' => $channel_id))){
                        return (int)$socialon;
                    }
            }
            return false;
        }


        function readCurrentPostShareLimit($facebook_id,$channel_id){

                $this->recursive = -1;
            if(isset($facebook_id) and isset($channel_id)){

                 $readers = $this->find('first',array('conditions' => array('ChannelsReader.facebook_id' => $facebook_id, 'channel_id' => $channel_id)));

                    if($readers != false and is_array($readers)){

                       return $readers['ChannelsReader']['maxshareperday'];

                    }

            }
            return false;
        }


        function setCurrentPostShareLimit($facebook_id,$channel_id,$newLimit){

            if(isset($facebook_id) and isset($newLimit)){
                    if($this->updateAll(array('maxshareperday' => $newLimit), array('ChannelsReader.facebook_id' => $facebook_id , 'channel_id' => $channel_id))){
                        return true;
                    }

            }
            return false;

        }
		
		public function getAppInstalledUsers($id){
			return $this->find('all',array('fileds'=>array('facebook_id'),'conditions'=>array('channel_id'=>$id)));
		}
}
