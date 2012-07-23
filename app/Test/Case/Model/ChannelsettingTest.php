<?php
App::uses('Channelsetting', 'Model');

/**
 * Channelsetting Test Case
 *
 */
class ChannelsettingTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.channelsetting', 'app.channel', 'app.feed', 'app.reader', 'app.facebook', 'app.channels_reader');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Channelsetting = ClassRegistry::init('Channelsetting');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Channelsetting);

		parent::tearDown();
	}

}
