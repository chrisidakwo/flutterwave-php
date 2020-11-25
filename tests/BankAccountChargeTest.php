<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use ChrisIdakwo\Flutterwave\Exceptions\InvalidRequestDataException;

class BankAccountChargeTest extends TestCase {
	public function testTransferDataIsInvalid() {
		$this->setExpectedException(InvalidRequestDataException::class);

		$this->rave->chargeBankAccount([]);
	}

	public function testTransferAmountIsNumeric() {
		$data = [
			'tx_ref' => '123456789',
			'amount' => '25000cbv',
			'account_bank' => '044',
			'account_number' => '9019029038',
			'email' => 'chris.idakwo@mail.com'
		];

		$this->setExpectedException(InvalidRequestDataException::class);

		$this->rave->chargeBankAccount($data);
	}

	public function testTransferIsSuccessful() {
		$data = [
			'tx_ref' => '123456789',
			'amount' => '25000',
			'account_bank' => '044',
			'account_number' => '9019029038',
			'email' => 'chris.idakwo@mail.com'
		];

		$this->setExpectedException(InvalidRequestDataException::class);

		$this->rave->chargeBankAccount($data);
	}
}
