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
        $data = ['amount' => 100];

        $refund = $this->rave->refundTransaction($transactionId, $data);

        self::assertEquals($refund->amountRefunded, $data['amount']);
    }
}
