<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use ChrisIdakwo\Flutterwave\Support\Environment;

abstract class TestCase extends \PHPUnit\Framework\TestCase {

	public Environment $environment;

	/**
	 * @inheritDoc
	 */
	protected function setUp(): void {
		parent::setUp();

		$this->environment = (new Environment(Environment::ENV_TEST));
	}
}
