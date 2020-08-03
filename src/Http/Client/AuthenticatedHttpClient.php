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

	    if ($requestBody !== '') {
		    $response = $this->http->getHttpClient()->post($request->getUrl(), [
			    'body' => $requestBody,
			    'headers' => $headers
		    ]);
	    } else {
		    $response = $this->http->getHttpClient()->post($request->getUrl(), [
			    'headers' => $headers
		    ]);
	    }

	    return $response->getBody();
    }

    /**
     * @inheritDoc
     */
    public function get(HttpGetRequest $request): string {
        $headers = $this->getHeaders();
        $response = $this->http->getHttpClient()->get($request->getUrl(), [
            'headers' => $headers
        ]);

        return $response->getBody();
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
