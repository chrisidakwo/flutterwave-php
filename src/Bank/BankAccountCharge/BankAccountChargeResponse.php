<?php

namespace ChrisIdakwo\Flutterwave\Bank\BankAccountCharge;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use JsonException;
use ReflectionException;

class BankAccountChargeResponse extends HttpResponse {
    /**
     * @return BankAccountCharge
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getBankAccountCharge(): BankAccountCharge {
        return new BankAccountCharge($this->getResponse()['data']);
    }
}
