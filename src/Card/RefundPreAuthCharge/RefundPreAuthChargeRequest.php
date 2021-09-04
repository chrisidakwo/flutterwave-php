<?php

namespace ChrisIdakwo\Flutterwave\Card\RefundPreAuthCharge;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class RefundPreAuthChargeRequest extends HttpPostRequest {
    public const URI = '/charges/{FLW_REF}/refund';
    private string $flutterwaveRef;

    public function __construct(string $url, string $flwRef, string $amount) {
        $this->flutterwaveRef = $flwRef;

        parent::__construct($url, ['amount' => $amount]);
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string {
        return str_replace('{FLW_REF}', $this->flutterwaveRef, $this->url);
    }
}
