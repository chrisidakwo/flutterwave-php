<?php

namespace ChrisIdakwo\Flutterwave\Validations;

use Respect\Validation\Exceptions\Exception;

abstract class Validator implements IValidator {

	public array $data;

	private string $errors;

	private bool $valid;

	public \Respect\Validation\Validator $validator;

	public function __construct(array $data) {
		$this->data = $data;
		$this->errors = '';
		$this->valid = false;
		$this->validator = \Respect\Validation\Validator::create();
	}

	/**
	 * @return bool
	 */
	public function validate(): self {
		try {
			$this->buildValidator()->assert($this->data);
		} catch (Exception $ex) {
			$this->errors = $ex->getFullMessage();

			return $this;
		}

		$this->valid = true;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isValid(): bool {
		return $this->valid;
	}

	abstract public function buildValidator(): \Respect\Validation\Validator;

	/**
	 * @return string
	 */
	public function getErrors(): string {
		return $this->errors;
	}
}
