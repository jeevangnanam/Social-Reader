<?php
App::uses('AppController', 'Controller');
/**
 * Feedrecords Controller
 *
 * @property Feedrecord $Feedrecord
 */
class FeedrecordsController extends AppController {


    public $uses = array('Reader','Feedrecord','Feedsocialsetting','Channel');

     public function beforeFilter(){
         
         parent::beforeFilter();
     }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Feedrecord->recursive = 0;
		$this->set('feedrecords', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
            $this->Feedrecord->recursive = 2;
             $user = $this->Session->read('user');
	     $channelDetails = $this->Session->read('channelDetails');
            
			 if(!isset($channelDetails) or empty($channelDetails)) {
                           $res = $this->Feedrecord->find('all',array('conditions' => array('Feedrecord.id' => $id)));
				 $channelDetails= ($res[0]['Feed']['Channel']);
			 }
            $this->layout = 'share';
		$this->Feedrecord->id = $id;
		if (!$this->Feedrecord->exists()) {
			throw new NotFoundException(__('Invalid feedrecord'));
		}
                $feedrecord =  $this->Feedrecord->read(null, $id);
		$this->set('feedrecord',$feedrecord);
                $this->set('title',$feedrecord['Feedrecord']['title']);
                preg_match('#<img[^>]+src=[\'"]([^\'"]+)[\'"]#', $feedrecord['Feedrecord']['description'], $matches);
                        if(count($matches)>1){
                            $image = $matches[1];
                             $this->set('image',$image);
                        }
                 $this->set('appId',$channelDetails['app_id']);
                $this->set('url',"http://".$_SERVER['SERVER_NAME']."/feedrecords/view/".$feedrecord['Feedrecord']['id']);
                $this->set('socialOn',  $this->Feedsocialsetting->checkSocialStatusOfFeedRecordOfUser($id,$user['id']));
                $this->set('user',$user['id']);
				if(isset($channelDetails['appicon']) or $channelDetails['appicon'] != ''){
				$this->set('icon',"http://".$_SERVER['SERVER_NAME']."/appproperties/".$channelDetails['name']."/img/"."favicon.ico");
				}
				
				$this->set('description', $feedrecord['Feedrecord']['description']);
	}

        /**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function viewajax($id = null) {
                $user = $this->Session->read('user');
             
        $this->layout = 'ajax';
		$this->Feedrecord->id = $id;
		if (!$this->Feedrecord->exists()) {
			throw new NotFoundException(__('Invalid feedrecord'));
		}
		$this->set('feedrecord', $this->Feedrecord->read(null, $id));               
                $this->set('socialOn',  $this->Feedsocialsetting->checkSocialStatusOfFeedRecordOfUser($id,$user['id']));
                $this->set('user',$user['id']);
                
	}


        public function shareit(){

                $user = $this->Session->read('user');
                $this->autoRender = false;

                $id = $this->request->pass[0];

                if(isset($id)){

                    $this->Feedrecord->recursive = -1;
                    $res = $this->Feedrecord->findById($id);
                    if($res != false and is_array($res)){

                        $title = $res['Feedrecord']['title'];
                        preg_match('#<img[^>]+src=[\'"]([^\'"]+)[\'"]#', $res['Feedrecord']['description'], $matches);
                        if(count($matches)>1){
                            $image = $matches[1];
                        }

                        $data['url'] = $url = "http://".$_SERVER['SERVER_NAME']."/feedrecords/view/".$res['Feedrecord']['id'];
                        $data['title'] = $title;
                        if(isset($image)){
                        $data['image'] = $image;
                        }
                        echo json_encode($data);
                    }
                }
            
        }

        public function onOffSocial($id){

            $user = $this->Session->read('user');

          //  $this->Feedsocialsetting->
        }
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Feedrecord->create();
			if ($this->Feedrecord->save($this->request->data)) {
				$this->Session->setFlash(__('The feedrecord has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedrecord could not be saved. Please, try again.'));
			}
		}
		$feeds = $this->Feedrecord->Feed->find('list');
		$this->set(compact('feeds'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Feedrecord->id = $id;
		if (!$this->Feedrecord->exists()) {
			throw new NotFoundException(__('Invalid feedrecord'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Feedrecord->save($this->request->data)) {
				$this->Session->setFlash(__('The feedrecord has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The feedrecord could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Feedrecord->read(null, $id);
		}
		$feeds = $this->Feedrecord->Feed->find('list');
		$this->set(compact('feeds'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Feedrecord->id = $id;
		if (!$this->Feedrecord->exists()) {
			throw new NotFoundException(__('Invalid feedrecord'));
		}
		if ($this->Feedrecord->delete()) {
			$this->Session->setFlash(__('Feedrecord deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Feedrecord was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
