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
		'url' => array(
			
			
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
		
		
	);

	public  function addFacebookResponse($facebook_id,$channel_id,$response,$url){

            if(isset($facebook_id) and isset($channel_id) and isset($response)){
            $data = array('Facebookresponse' => array(
				'response' => $response,
                'facebook_id' => $facebook_id,
                'channel_id'  => $channel_id,
				'url'  => $url,
				'read' => date('Y-m-d h:m:s'),
				'status' => 1,
            ));
            return $this->save($data);
            }
            return false;
            
     }
	public function checkMaxSharingLimit($channelId,$facebook_id,$date){
			return $this->find('count',array(
			'conditions' => array('Facebookresponse.channel_id' => $channelId,'Facebookresponse.facebook_id' => $facebook_id,"date(Facebookresponse.read)" => $date)
			
			
			));
			
		}
	public function lastTenShares($id,$facebook_id){
		
		$res  =  $this->find('all',array(
		'conditions'=>array('Facebookresponse.status' => 1,'Facebookresponse.facebook_id' => $facebook_id,'Facebookresponse.channel_id' => $id),
		'fields' => array('url','response','facebook_id'),
		'order' => array('Facebookresponse.id DESC'),
		'limit'=>10,
		 
		));
		
		$a = NULL;
		foreach($res as $value){
			
			$a++;
			 $tags[$a]['title'] = $this->file_get_contents_curl($value['Facebookresponse']['url']);
			 $tags[$a]['response'] = $value['Facebookresponse']['response'];
			 
			}
		
		
		return $tags;
	}
	
	public  function deleteFacebookResponse($id){

            if(isset($id)){
            $data = array('Facebookresponse' => array(
				'response'=>$id,
				'status' => 0,
            ));
            return $this->save($data);
            }
            return false;
            
     }
	 
	 
function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);


	
	$html = $data;

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

$metas = $doc->getElementsByTagName('meta');

		for ($i = 0; $i < $metas->length; $i++)
		{
			$meta = $metas->item($i);
			if($meta->getAttribute('property') == 'og:title')
				$title = $meta->getAttribute('content');
			
		}
return $title;
}



	
}
