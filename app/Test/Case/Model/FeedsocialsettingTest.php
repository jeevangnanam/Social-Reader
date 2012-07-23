<?php
App::uses('Feedsocialsetting', 'Model');

/**
 * Feedsocialsetting Test Case
 *
 */
class FeedsocialsettingTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.feedsocialsetting', 'app.record', 'app.facebook');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Feedsocialsetting = ClassRegistry::init('Feedsocialsetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Feedsocialsetting);

		parent::tearDown();
	}

}
