<?php
App::uses('Feedrecord', 'Model');

/**
 * Feedrecord Test Case
 *
 */
class FeedrecordTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.feedrecord', 'app.feed', 'app.channel', 'app.reader');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Feedrecord = ClassRegistry::init('Feedrecord');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Feedrecord);

		parent::tearDown();
	}

}
