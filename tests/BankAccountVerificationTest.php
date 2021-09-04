<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use GuzzleHttp\Exception\ClientException;

class BankAccountVerificationTest extends TestCase {
    public function testBankAccountDetailsAreValid() {
        $response = $this->rave->verifyBankAccount('044', '0690000031');

        self::assertSame('success', $response['status']);

        self::assertArrayHasKey('account_name', $response['data']);

        self::assertSame('0690000031', $response['data']['account_number']);

        // Because this is a test account number, the account name can be changed
        // at any time, so to avoid having the test fail we can comment out the line below
        //self::assertSame('Forrest Green', $response['data']['account_name']);
    }

    public function testBankAccountDetailsAreInValid() {
        $this->setExpectedException(ClientException::class);

        $response = $this->rave->verifyBankAccount('043', '0690000031');

        $isArray = is_array($response);
        self::assertTrue($isArray);

        self::assertSame($response['status'], 'error');
        self::assertSame($response['message'], 'Please specify the following parameters in body: account_number, account_bank');
        self::assertNull($response['data']);
    }
}
