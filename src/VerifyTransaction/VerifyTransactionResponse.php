<?php

namespace ChrisIdakwo\Flutterwave\VerifyTransaction;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use ChrisIdakwo\Flutterwave\Transaction\Transaction;
use JsonException;
use ReflectionException;

class VerifyTransactionResponse extends HttpResponse {
    /**
     * @return Transaction
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getTransaction(): Transaction {
        return new Transaction($this->getResponse()['data']);
    }
}
