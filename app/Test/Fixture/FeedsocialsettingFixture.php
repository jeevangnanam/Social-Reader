<?php
/**
 * FeedsocialsettingFixture
 *
 */
class FeedsocialsettingFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'record_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'facebook_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
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
			'record_id' => 1,
			'facebook_id' => 1,
			'created' => '2012-07-16 00:35:46',
			'modified' => '2012-07-16 00:35:46'
		),
	);
}
