<?php

namespace ChrisIdakwo\Flutterwave\Http\Response;

use ChrisIdakwo\Flutterwave\Http\Response\Contracts\HttpResponse as HttpResponseContract;

class HttpResponse implements HttpResponseContract {
    private string $response;

    public function __construct(string $response) {
        $this->response = $response;
    }

    /**
     * @inheritDoc
     */
    public function getResponse(): array {
        return (array)\GuzzleHttp\json_decode($this->response, true, 512, JSON_THROW_ON_ERROR);
    }
}
