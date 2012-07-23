<?php
/**
 * ChannelsReaderFixture
 *
 */
class ChannelsReaderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'facebook_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 250),
		'channel_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'socialon' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'isuninstalled' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'facebook_id' => 1,
			'channel_id' => 1,
			'socialon' => 1,
			'isuninstalled' => 1,
			'created' => '2012-07-19 18:14:34',
			'modified' => '2012-07-19 18:14:34'
		),
	);
}
