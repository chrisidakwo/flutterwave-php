<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use ChrisIdakwo\Flutterwave\Exceptions\InvalidRequestDataException;
use ChrisIdakwo\Flutterwave\Support\Entities\Authorization;

class ChargeCardTest extends TestCase {
    public function testChargeDataIsInvalid(): void {
        $this->setExpectedException(InvalidRequestDataException::class);

        $this->rave->chargeCard([]);
    }

    public function testChargeCardNeedsAuthorization(): void {
        $data = [
            'tx_ref' => 'RV-123456789',
            'amount' => '1800',
            'currency' => 'NGN',
            'card_number' => '5531886652142950',
            'cvv' => '564',
            'expiry_month' => 9,
            'expiry_year' => 32,
            'email' => 'test@email.com'
        ];

        $response = $this->rave->chargeCard($data);

        self::assertInternalType('array', $response->fields);
        self::assertInstanceOf(Authorization::class, $response);
    }
}
