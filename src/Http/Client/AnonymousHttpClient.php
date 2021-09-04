<?php

namespace ChrisIdakwo\Flutterwave\Http\Client;

use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpGetRequest;
use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpPostRequest;
use GuzzleHttp\Client as GuzzleHttpClient;

class AnonymousHttpClient implements HttpClient {
    private GuzzleHttpClient $http;

    public function __construct(GuzzleHttpClient $httpClient) {
        $this->http = $httpClient;
    }

    /**
     * @inheritDoc
     */
    public function post(HttpPostRequest $request): string {
        $requestBody = json_encode($request->getBody(), JSON_THROW_ON_ERROR);

        $response = $this->http->post($request->getUrl(), [
            'body' => $requestBody
        ]);

        return (string)\GuzzleHttp\json_encode(\GuzzleHttp\json_decode($response->getBody(), true, 512, JSON_PRETTY_PRINT));
    }

    /**
     * @inheritDoc
     */
    public function get(HttpGetRequest $request): string {
        $response = $this->http->get($request->getUrl());

        return (string)\GuzzleHttp\json_encode(\GuzzleHttp\json_decode($response->getBody(), true, 512, JSON_PRETTY_PRINT));
    }

    /**
     * @return GuzzleHttpClient
     */
    public function getHttpClient(): GuzzleHttpClient {
        return $this->http;
    }
}
