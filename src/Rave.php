<?php

namespace ChrisIdakwo\Flutterwave;

use ChrisIdakwo\Flutterwave\Exceptions\InvalidRequestDataException;
use ChrisIdakwo\Flutterwave\Exceptions\InvalidSecretKey;
use ChrisIdakwo\Flutterwave\Http\Client\AnonymousHttpClient;
use ChrisIdakwo\Flutterwave\Http\Client\AuthenticatedHttpClient;
use ChrisIdakwo\Flutterwave\StandardPayment\StandardPaymentRequest;
use ChrisIdakwo\Flutterwave\StandardPayment\StandardPaymentResponse;
use ChrisIdakwo\Flutterwave\Support\Environment;
use ChrisIdakwo\Flutterwave\Validations\StandardPaymentValidator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Rave {
    public const LIVE_BASE_URL = 'https://api.ravepay.co';
    public const STAGING_BASE_URL = 'https://ravesandboxapi.flutterwave.com';

    private AnonymousHttpClient $anonymousHttpClient;
    private AuthenticatedHttpClient $authenticatedHttpClient;

    /**
     * Rave constructor.
     *
     * @param string $secretKey
     * @throws InvalidSecretKey
     */
    public function __construct(string $secretKey) {
        if (empty($secretKey)) {
            throw new InvalidSecretKey('The secret key cannot be an empty string!');
        }

        $this->anonymousHttpClient = new AnonymousHttpClient(new Client);
        $this->authenticatedHttpClient = new AuthenticatedHttpClient($this->anonymousHttpClient, $secretKey);
    }

    /**
     * Static constructor. Convenient method primarily for testing.
     *
     * @return static
     * @throws InvalidSecretKey
     */
    public static function make(): self {
        $secretToken = (new Environment)->getSecretKey();

        return new static($secretToken);
    }

    /**
     * @param array $data
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws InvalidRequestDataException
     */
    public function standardPayment(array $data): array {
        $validator = (new StandardPaymentValidator($data))->validate();
        if (!$validator->isValid()) {
            throw new InvalidRequestDataException($validator->getErrors());
        }

        $standardPaymentRequest = (new StandardPaymentRequest($data));

        $response = $this->authenticatedHttpClient->post($standardPaymentRequest);

        $standardPaymentResponse = new StandardPaymentResponse($response);

        return $standardPaymentResponse->getResponse();
    }
}
