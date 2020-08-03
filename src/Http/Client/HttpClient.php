<?php

namespace ChrisIdakwo\Flutterwave\Http\Client;

use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpGetRequest;
use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpPostRequest;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

interface HttpClient {
    /**
     * Makes a POST request.
     *
     * @param HttpPostRequest $request
     * @return string
     * @throws GuzzleException
     * @throws JsonException
     */
    public function post(HttpPostRequest $request): string;

    /**
     * Makes a GET request.
     *
     * @param HttpGetRequest $request
     * @return string
     * @throws GuzzleException
     */
    public function get(HttpGetRequest $request): string;
}
