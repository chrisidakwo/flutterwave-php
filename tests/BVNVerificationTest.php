<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use GuzzleHttp\Exception\ClientException;

class BVNVerificationTest extends TestCase {
	public function testBVNIsValid() {
		$response = $this->rave->verifyBVN('123456789');

		self::assertSame('123456789', $response->bvn);
	}

	public function testBVNIsInvalid() {
		$this->setExpectedException(ClientException::class);

		$response = $this->rave->verifyBVN('1234890489');
	}

	public function testInsufficientBalance() {
		$this->setExpectedException(ClientException::class);

		$response = $this->rave->verifyBVN('1234890489');

		$isArray = is_array($response);
		self::assertTrue($isArray);

		self::assertSame($response['status'], 'error');
		self::assertSame($response['message'], 'Insufficient balance to carry out this transaction');
		self::assertNull($response['data']);
	}
}
