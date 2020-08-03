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

        return $response->getBody();
    }

    /**
     * @inheritDoc
     */
    public function get(HttpGetRequest $request): string {
        $response = $this->http->get($request->getUrl());

        return $response->getBody();
    }

    /**
     * @return GuzzleHttpClient
     */
    public function getHttpClient(): GuzzleHttpClient {
        return $this->http;
    }
}
