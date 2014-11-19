<?php

/**
 * GenreFixture
 *
 */
class GenreFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'charset' => 'utf8mb4'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified_by' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci', 'engine' => 'InnoDB')
	);
	/**
	 * Records
	 *
	 * @var array
	 */
	public $records = array(
		array(
			'id' => 1,
			'title' => 'Rock',
			'created' => '2014-11-14 15:24:05',
			'created_by' => 1,
			'modified' => '2014-11-14 15:24:05',
			'modified_by' => 1
		),
		array(
			'id' => 2,
			'title' => 'House',
			'created' => '2014-11-13 10:30:05',
			'created_by' => 1,
			'modified' => '2014-11-14 15:24:05',
			'modified_by' => 1
		),
		array(
			'id' => 134,
			'title' => 'Electro Minimal',
			'created' => '2014-11-12 14:24:05',
			'created_by' => 1,
			'modified' => '2014-11-14 15:24:05',
			'modified_by' => 1
		),
	);

}
