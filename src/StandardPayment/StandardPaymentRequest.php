<?php

namespace ChrisIdakwo\Flutterwave\StandardPayment;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class StandardPaymentRequest implements HttpPostRequest {
    public const URI = 'https://api.flutterwave.com/v3/payments';

    private ?array $data;

    /**
     * StandardPaymentRequest constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        $this->setBody($data);
    }

    /**
     * @inheritDoc
     */
    public function getUrl(): string {
        return self::URI;
    }

    /**
     * @inheritDoc
     */
    public function setBody(array $data = []): self {
        $this->data = $data;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getBody(): string {
        return json_encode($this->data, JSON_THROW_ON_ERROR);
    }
}
