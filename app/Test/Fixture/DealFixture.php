<?php
/**
 * DealFixture
 *
 */
class DealFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'deal_category_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'company_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'highlights' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'conditions' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'threshold' => array('type' => 'integer', 'null' => false, 'default' => null),
		'marked_price' => array('type' => 'integer', 'null' => false, 'default' => null),
		'discount' => array('type' => 'integer', 'null' => true, 'default' => null),
		'selling_price' => array('type' => 'integer', 'null' => false, 'default' => null),
		'expiry_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'buy_count' => array('type' => 'integer', 'null' => true, 'default' => null),
		'view_count' => array('type' => 'integer', 'null' => true, 'default' => null),
		'image1' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image3' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image4' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image5' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image6' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image7' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image8' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image9' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image10' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'status' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'deal_category_id' => 1,
			'company_id' => 1,
			'highlights' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'conditions' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'threshold' => 1,
			'marked_price' => 1,
			'discount' => 1,
			'selling_price' => 1,
			'expiry_date' => '2014-04-08',
			'buy_count' => 1,
			'view_count' => 1,
			'image1' => 'Lorem ipsum dolor sit amet',
			'image2' => 'Lorem ipsum dolor sit amet',
			'image3' => 'Lorem ipsum dolor sit amet',
			'image4' => 'Lorem ipsum dolor sit amet',
			'image5' => 'Lorem ipsum dolor sit amet',
			'image6' => 'Lorem ipsum dolor sit amet',
			'image7' => 'Lorem ipsum dolor sit amet',
			'image8' => 'Lorem ipsum dolor sit amet',
			'image9' => 'Lorem ipsum dolor sit amet',
			'image10' => 'Lorem ipsum dolor sit amet',
			'status' => 1
		),
	);

}
