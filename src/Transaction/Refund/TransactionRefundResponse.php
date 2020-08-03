<?php

namespace ChrisIdakwo\Flutterwave\Transaction\Refund;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use JsonException;
use ReflectionException;

class TransactionRefundResponse extends HttpResponse {
    /**
     * @return Refund
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getRefund(): Refund {
        return new Refund($this->getResponse()['data']);
    }
}
