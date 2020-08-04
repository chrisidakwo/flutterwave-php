<?php

namespace ChrisIdakwo\Flutterwave\Transaction\Refund;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class TransactionRefundRequest extends HttpPostRequest {
    public const URI = '/transactions/{id}/refund';

    public string $transactionId;

    /**
     * RefundTransactionRequest constructor.
     *
     * @param string $transactionId
     * @param string $url
     * @param int|float $amount
     */
    public function __construct(string $transactionId, string $url, $amount) {
        $this->transactionId = $transactionId;
        $data = ['amount' => $amount];

        parent::__construct($url, $data);
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string {
        return str_replace('{id}', $this->transactionId, $this->url);
    }
}
