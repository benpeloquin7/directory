<?php
App::uses('Hoody', 'Model');

/**
 * Hoody Test Case
 *
 */
class HoodyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.hoody',
		'app.user',
		'app.poll',
		'app.vote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Hoody = ClassRegistry::init('Hoody');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Hoody);

		parent::tearDown();
	}

}
