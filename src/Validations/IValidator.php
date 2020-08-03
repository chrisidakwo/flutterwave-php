<?php

namespace ChrisIdakwo\Flutterwave\Validations;

interface IValidator {
	/**
	 * @return self
	 */
	public function validate(): self;
}
