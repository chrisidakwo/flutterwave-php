<?php

namespace ChrisIdakwo\Flutterwave\ValidateCharge;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use ChrisIdakwo\Flutterwave\Transaction\Transaction;
use JsonException;

class ValidateChargeResponse extends HttpResponse {
    /**
     * @return Transaction
     * @throws JsonException
     */
    public function getValidatedCharge(): Transaction {
        $response = $this->getResponse();

        return new Transaction($response['data']);
    }
}
