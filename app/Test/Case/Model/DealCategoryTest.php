<?php
App::uses('DealCategory', 'Model');

/**
 * DealCategory Test Case
 *
 */
class DealCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.deal_category',
		'app.deal',
		'app.company',
		'app.city'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DealCategory = ClassRegistry::init('DealCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DealCategory);

		parent::tearDown();
	}

}
