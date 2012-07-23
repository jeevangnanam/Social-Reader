<?php
App::uses('ChannelsReader', 'Model');

/**
 * ChannelsReader Test Case
 *
 */
class ChannelsReaderTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.channels_reader', 'app.facebook', 'app.channel', 'app.reader');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ChannelsReader = ClassRegistry::init('ChannelsReader');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ChannelsReader);

		parent::tearDown();
	}

}
