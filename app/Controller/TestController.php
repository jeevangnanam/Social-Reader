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
class TestController extends AppController {

    /**
     * Controller name
     *
     * @var string
     * @access public
     */
    public $name = 'Test';
    /**
     * Helpers
     */
   function index(){
	   $this->layout ='test';
	   $this->set('globalSocialStatusForThisApp',true);
	   $this->set('layout','adaderana');
	   
	   
	   }

}
