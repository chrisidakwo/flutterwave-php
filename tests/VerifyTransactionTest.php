<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use ReflectionException;

class VerifyTransactionTest extends TestCase {
    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testInvalidTransactionKey(): void {
        $this->setExpectedException(ClientException::class);

        $response = $this->rave->verifyTransaction('1235665');

        $isArray = is_array($response);
        self::assertTrue($isArray);

        self::assertSame($response['status'], 'error');
        self::assertNull($response['data']);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testTransactionEntityClassIsWellFormed(): void {
        $transaction = $this->rave->verifyTransaction('1445841');

        self::assertNotNull($transaction->id);
        self::assertNotNull($transaction->amount);
        self::assertNotNull($transaction->chargedAmount);
        self::assertNotNull($transaction->amountSettled);

        $isObject = is_object($transaction->customer);
        self::assertTrue($isObject);

        self::assertObjectHasAttribute('name', $transaction->customer);
        self::assertObjectHasAttribute('email', $transaction->customer);
        self::assertObjectHasAttribute('phone_number', $transaction->customer);

        if ($transaction->paymentType === 'account') {
            self::assertNotNull($transaction->account);

            self::assertNull($transaction->card);

            $isObject = is_object($transaction->account);
            self::assertTrue($isObject);
        }

        if ($transaction->paymentType === 'card') {
            self::assertNotNull($transaction->card);

            self::assertNull($transaction->account);

            $isObject = is_object($transaction->card);
            self::assertTrue($isObject);
        }
    }
}
