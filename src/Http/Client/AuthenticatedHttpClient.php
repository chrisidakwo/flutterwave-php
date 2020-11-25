<?php

namespace ChrisIdakwo\Flutterwave\Http\Client;

use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpGetRequest;
use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpPostRequest;

class AuthenticatedHttpClient implements HttpClient {
    /**
     * Base http client without authentication.
     */
    private AnonymousHttpClient $http;

    /**
     * Secret key provided by Flutterwave. Used to initialize http client headers.
     */
    private string $token;

    public function __construct(AnonymousHttpClient $anonymousHttpClient, string $token) {
        $this->http = $anonymousHttpClient;
        $this->token = $token;
    }

    /**
     * @inheritDoc
     */
    public function post(HttpPostRequest $request): string {
        $requestBody = $request->getBody();
        $headers = $this->getHeaders();

        if ($requestBody === '') {
            $options = ['headers' => $headers];
        } else {
            $options = ['body' => $requestBody, 'headers' => $headers];
        }

        $response = $this->http->getHttpClient()->post($request->getUrl(), $options);

        return (string)\GuzzleHttp\json_encode(\GuzzleHttp\json_decode($response->getBody(), true, 512, JSON_PRETTY_PRINT));
    }

    /**
     * @inheritDoc
     */
    public function get(HttpGetRequest $request): string {
        $headers = $this->getHeaders();
        $response = $this->http->getHttpClient()->get($request->getUrl(), [
            'headers' => $headers
        ]);

        return (string)\GuzzleHttp\json_encode(\GuzzleHttp\json_decode($response->getBody(), true, 512, JSON_PRETTY_PRINT));
    }

    /**
     * Get headers for authenticated requests.
     *
     * @return array|string[]
     */
    private function getHeaders(): array {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $this->token"
        ];
    }
}
