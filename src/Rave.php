<?php

namespace ChrisIdakwo\Flutterwave;

use ChrisIdakwo\Flutterwave\Exceptions\InvalidRequestDataException;
use ChrisIdakwo\Flutterwave\Exceptions\InvalidSecretKey;
use ChrisIdakwo\Flutterwave\Http\Client\AnonymousHttpClient;
use ChrisIdakwo\Flutterwave\Http\Client\AuthenticatedHttpClient;
use ChrisIdakwo\Flutterwave\StandardPayment\StandardPaymentRequest;
use ChrisIdakwo\Flutterwave\StandardPayment\StandardPaymentResponse;
use ChrisIdakwo\Flutterwave\Support\Validations\StandardPaymentValidator;
use ChrisIdakwo\Flutterwave\Transaction\Refund\Refund;
use ChrisIdakwo\Flutterwave\Transaction\Refund\TransactionRefundRequest;
use ChrisIdakwo\Flutterwave\Transaction\Refund\TransactionRefundResponse;
use ChrisIdakwo\Flutterwave\Transaction\Transaction;
use ChrisIdakwo\Flutterwave\VerifyTransaction\VerifyTransactionRequest;
use ChrisIdakwo\Flutterwave\VerifyTransaction\VerifyTransactionResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use ReflectionException;

class Rave {
    public string $baseUrl;
    private AuthenticatedHttpClient $authenticatedHttpClient;

    /**
     * Rave constructor.
     *
     * @param string $secretKey
     * @param string $baseUrl
     * @throws InvalidSecretKey
     */
    public function __construct(string $secretKey, string $baseUrl) {
        if (empty($secretKey)) {
            throw new InvalidSecretKey('The secret key cannot be an empty string!');
        }

        $anonymousHttpClient = new AnonymousHttpClient(new Client);
        $this->authenticatedHttpClient = new AuthenticatedHttpClient($anonymousHttpClient, $secretKey);

        $this->baseUrl = $baseUrl;
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

        $standardPaymentRequest = (new StandardPaymentRequest('', $data));

        $response = $this->authenticatedHttpClient->post($standardPaymentRequest);

        $standardPaymentResponse = new StandardPaymentResponse($response);

        return $standardPaymentResponse->getResponse();
    }

    /**
     * @param string $transactionId
     * @return Transaction
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function verifyTransaction(string $transactionId): Transaction {
        $verifyTransactionRequest = (new VerifyTransactionRequest($transactionId, $this->baseUrl . VerifyTransactionRequest::URI));

        $response = $this->authenticatedHttpClient->get($verifyTransactionRequest);

        $verifyTransactionResponse = new VerifyTransactionResponse($response);

        return $verifyTransactionResponse->getTransaction();
    }

    /**
     * @param string $transactionId
     * @param int $amount
     * @return Refund
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function refundTransaction(string $transactionId, int $amount): Refund {
        $refundTransactionRequest = (new TransactionRefundRequest($transactionId, $this->baseUrl . TransactionRefundRequest::URI, $amount));

        $response = $this->authenticatedHttpClient->post($refundTransactionRequest);

        $refundTransactionResponse = new TransactionRefundResponse($response);

        return $refundTransactionResponse->getRefund();
    }
}
