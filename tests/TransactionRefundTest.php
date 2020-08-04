<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use ReflectionException;

class TransactionRefundTest extends TestCase {
    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function testRefundIsSuccessful(): void {
        $transactionId = getenv('ACCOUNT_TRANSACTION');

        $refund = $this->rave->refundTransaction($transactionId, 100);

        self::assertEquals($refund->amountRefunded, 100);
    }
}
