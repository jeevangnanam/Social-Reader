<?php

class CroneController extends AppController {


    public $name = 'Crone';
    public $uses = array('Feedrecord','Feed');

    public function beforeFilter() {
		parent::beforeFilter();

    }

    public function run(){
        $this->autoRender = false;
        if(!isset($this->request->pass[0]) or is_null($this->request->pass[0])){

            $channel = 'all';
        }else{
            $channel = $this->request->pass[0];
        }

        $this->_load($channel);
    }
    private function _load($channel='all') {

        #Config
        $this->Feed->recursive = -1;
        if(!isset($channel) or empty($channel)){

            $channel = 'all';
        }

        if($channel == 'all'){

            $feedList = $this->Feed->find('all',array('conditions' => array('status' => '1' )));


        }else{
            
            $feedList = $this->Feed->find('all',array('conditions' => array('status' => '1' ,'channel_id' => $channel)));


        }

        

            try{

                if(count($feedList) == 0){
                throw new Exception('Feeds are not found'.date('Y-m-d h:i:s'));
                }else{

                     foreach( $feedList as $thisFeed){
                         
                       

                            $this->_addOrUpdateFeedRecord($thisFeed);
                     }

                }
            }catch(Exception $e){
                //Send email
            }



    
    }



    private function _addOrUpdateFeedRecord($feed){

     
        if(isset($feed)){

              $thisFeedProp = Xml::build($feed['Feed']['path']);

              $this->_saveRecords($thisFeedProp,$feed['Feed']['id']);
           
        }
        return false;

    }


    private function _saveRecords($thisFeedProp,$feedId){


      foreach($thisFeedProp->channel->item as $item){


           $date = date("Y-m-d h:i:s", strtotime($item->pubDate));
          $data = array(
            'Feedrecord' => array(
                'feed_id' => $feedId,
                'title' =>  $item->title,
                'description' => $item->description,
                'link' => $item->link,
                'date' => $date,
                'status' => 1
            )
        );

          $duplicateCheckRes =  $this->_checkForDuplicate($item->title, $feedId);
          if($duplicateCheckRes === false){
                $this->Feedrecord->create();
                $this->Feedrecord->save($data);

          }else{

              $updateCheck = $this->_checkForUpdate($duplicateCheckRes,$date);
              if($updateCheck === true){
              $this->Feedrecord->id = $duplicateCheckRes['Feedrecord']['id'];
              $this->Feedrecord->save($data);
              }

          }
          
      }



        
        
    }


    private function _checkForDuplicate($title,$feedId){
            $this->Feedrecord->recursive = -1;
            $isRecordExists  =  $this->Feedrecord->find('first',array('conditions' => array('title' => $title,'feed_id' => $feedId)));

            if($isRecordExists !== false){
                return $isRecordExists;
            }
            return false;
    }

    private function _checkForUpdate($record,$date){

            $this->Feedrecord->recursive = -1;
            $isUpdated  =   $this->Feedrecord->find('first',array('conditions' => array('title' => $record['Feedrecord']['title'],'date' => $date)));

            if($isUpdated === false){
               return true;
            }

            return false;

    }
}
?>