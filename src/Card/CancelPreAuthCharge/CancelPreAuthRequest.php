<?php

namespace ChrisIdakwo\Flutterwave\Card\CancelPreAuthCharge;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class CancelPreAuthRequest extends HttpPostRequest {
    public const URI = '/charges/{FLW_REF}/void';
    private string $flutterwaveRef;

    /**
     * CancelPreAuthRequest constructor.
     *
     * @param string $flwRef
     * @param string $url
     * @param array $data
     */
    public function __construct(string $flwRef, string $url, $data = []) {
        parent::__construct($url, $data);
        $this->flutterwaveRef = $flwRef;
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string {
        return str_replace('{FLW_REF}', $this->flutterwaveRef, $this->url);
    }
}
