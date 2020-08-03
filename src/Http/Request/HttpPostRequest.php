<?php

namespace ChrisIdakwo\Flutterwave\Http\Request;

use JsonException;

interface HttpPostRequest {
    /**
     * Returns the URL for the POST request.
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param array|null $data
     * @return self
     */
    public function setBody(array $data = []): self;

    /**
     * Returns the body (data) for the POST request.
     *
     * @return string
     * @throws JsonException
     */
    public function getBody(): string;
}
