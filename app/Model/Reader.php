<?php
App::uses('AppModel', 'Model');
/**
 * Reader Model
 *
 * @property Facebook $Facebook
 * @property Channel $Channel
 */
class Reader extends AppModel {
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
			'unique' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date_of_birth' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'marital_status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'Facebook' => array(
			'className' => 'Facebook',
			'foreignKey' => 'facebook_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Channel' => array(
			'className' => 'Channel',
			'joinTable' => 'channels_readers',
			'foreignKey' => 'facebook_id',
			'associationForeignKey' => 'channel_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);






  public function saveReader($data) {

        if (isset($data['id'])) {


            $date = date("Y-m-d", strtotime($data['birthday']));
            $readerdetails = array(
                'Reader' => array(
                    'facebook_id' => $data['id'],
                    
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'date_of_birth' => $date,
                    'marital_status' => $data['marital_status'],
                    
                )
            );



            //$q = sprintf("insert into readers(facebook_id,channel_id,first_name,last_name,email,date_of_birth,marital_status,uninstalled_the_app)
            //   values('%s','%s','%s','%s','%s','%s','%s','%s')",$data['id'],1,$data['first_name'],$data['last_name'],$data['email'],$date,'',0);
            //$this->query($q);

       $this->save($readerdetails);
        }
    }
}
