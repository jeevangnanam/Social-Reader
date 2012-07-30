<?php
App::uses('AppController', 'Controller');
/**
 * Feedrecords Controller
 *
 * @property Feedrecord $Feedrecord
 */
class ToolbarsController extends AppController {


			var $uses =  array();
			
			 public function beforeFilter(){

        			 parent::beforeFilter();
		 			$this->Auth->allow('index');
     		}
			
			
			
			function index(){
				
				$this->layout = 'toolbars';
				
				}

}
