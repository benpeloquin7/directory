<?php
App::uses('Poll', 'Model');

/**
 * Poll Test Case
 *
 */
class PollTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.poll',
		'app.user',
		'app.hoody',
		'app.vote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Poll = ClassRegistry::init('Poll');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Poll);

		parent::tearDown();
	}

}
