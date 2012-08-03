<?php
App::uses('AppModel', 'Model');
/**
 * Feedsocialsetting Model
 *
 * @property Record $Record
 * @property Facebook $Facebook
 */
class Feedsocialsetting extends AppModel {
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'feedrecord_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Feedrecord' => array(
			'className' => 'Feedrecord',
			'foreignKey' => 'feedrecord_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
	);



     


        public function onOffSocial($statusCode,$feedRecordId,$facebook_id){

        
            if(isset($feedRecordId)){

                if($statusCode === null){

                    $data = array('Feedsocialsetting' => array(

                        'feedrecord_id' => $feedRecordId,
                        'facebook_id' => $facebook_id,
                        'on' => 1
                    ));

                   $res =  $this->save($data);
                   return $res['Feedsocialsetting']['on'];
                }else{
                $statusCode = ($statusCode==1)?0:1;
                    if($this->updateAll(array('on' => $statusCode), array('feedrecord_id' => $feedRecordId , 'facebook_id' => $facebook_id))){
                        return $statusCode;
                    }
                }

            }
                    return false;
        }

        public function checkSocialStatusOfFeedRecordOfUser($feedRecordId,$facebook_id){
                $this->recursive = -1;
                $res = $this->find('first',array('conditions' => array('feedrecord_id' => $feedRecordId,'facebook_id' => $facebook_id)));

                if($res === false)return true;
                
                if(is_array($res)){
                         return (int)$res['Feedsocialsetting']['on'];
                }


                return false;
        }
        
}

