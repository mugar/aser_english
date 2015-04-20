<?php
/* Caiss Fixture generated on: 2011-09-16 16:09:29 : 1316179769 */
class CaissFixture extends CakeTestFixture {
	var $name = 'Caiss';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'total' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'actif' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'personnel_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 20),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'total' => 1,
			'actif' => 1,
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'personnel_id' => 1,
			'created' => '2011-09-16 16:29:29',
			'modified' => '2011-09-16 16:29:29'
		),
	);
}
?>