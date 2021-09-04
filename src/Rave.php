<?php

namespace ChrisIdakwo\Flutterwave;

use ChrisIdakwo\Flutterwave\Bank\BankAccountCharge\BankAccountCharge;
use ChrisIdakwo\Flutterwave\Bank\BankAccountCharge\BankAccountChargeRequest;
use ChrisIdakwo\Flutterwave\Bank\BankAccountCharge\BankAccountChargeResponse;
use ChrisIdakwo\Flutterwave\Bank\BankAccountVerification\BankAccountVerificationRequest;
use ChrisIdakwo\Flutterwave\Bank\BankAccountVerification\BankAccountVerificationResponse;
use ChrisIdakwo\Flutterwave\Bank\BankTransfer\BankTransferRequest;
use ChrisIdakwo\Flutterwave\Bank\BankTransfer\BankTransferResponse;
use ChrisIdakwo\Flutterwave\BVN\BVNVerificationRequest;
use ChrisIdakwo\Flutterwave\BVN\BVNVerificationResponse;
use ChrisIdakwo\Flutterwave\Card\CancelPreAuthCharge\CancelPreAuthRequest;
use ChrisIdakwo\Flutterwave\Card\CancelPreAuthCharge\CancelPreAuthResponse;
use ChrisIdakwo\Flutterwave\Card\CapturePreAuthCharge\ChargePreAuthCardRequest;
use ChrisIdakwo\Flutterwave\Card\CapturePreAuthCharge\ChargePreAuthCardResponse;
use ChrisIdakwo\Flutterwave\Card\ChargeCard\ChargeCard;
use ChrisIdakwo\Flutterwave\Card\ChargeCard\ChargeCardRequest;
use ChrisIdakwo\Flutterwave\Card\ChargeCard\ChargeCardResponse;
use ChrisIdakwo\Flutterwave\Card\ChargeCardToken\ChargeCardTokenRequest;
use ChrisIdakwo\Flutterwave\Card\ChargeCardToken\ChargeCardTokenResponse;
use ChrisIdakwo\Flutterwave\Card\RefundPreAuthCharge\RefundPreAuthChargeRequest;
use ChrisIdakwo\Flutterwave\Card\RefundPreAuthCharge\RefundPreAuthChargeResponse;
use ChrisIdakwo\Flutterwave\Exceptions\InvalidRequestDataException;
use ChrisIdakwo\Flutterwave\Exceptions\InvalidSecretKey;
use ChrisIdakwo\Flutterwave\Http\Client\AnonymousHttpClient;
use ChrisIdakwo\Flutterwave\Http\Client\AuthenticatedHttpClient;
use ChrisIdakwo\Flutterwave\StandardPayment\StandardPaymentRequest;
use ChrisIdakwo\Flutterwave\StandardPayment\StandardPaymentResponse;
use ChrisIdakwo\Flutterwave\Support\Entities\Authorization;
use ChrisIdakwo\Flutterwave\Support\Validators\BankAccountChargeValidator;
use ChrisIdakwo\Flutterwave\Support\Validators\BankTransferValidator;
use ChrisIdakwo\Flutterwave\Support\Validators\ChargeCardTokenValidator;
use ChrisIdakwo\Flutterwave\Support\Validators\ChargeCardValidator;
use ChrisIdakwo\Flutterwave\Support\Validators\StandardPaymentValidator;
use ChrisIdakwo\Flutterwave\Support\Validators\ValidateChargeValidator;
use ChrisIdakwo\Flutterwave\Transaction\Refund\Refund;
use ChrisIdakwo\Flutterwave\Transaction\Refund\TransactionRefundRequest;
use ChrisIdakwo\Flutterwave\Transaction\Refund\TransactionRefundResponse;
use ChrisIdakwo\Flutterwave\Transaction\Transaction;
use ChrisIdakwo\Flutterwave\ValidateCharge\ValidateChargeRequest;
use ChrisIdakwo\Flutterwave\ValidateCharge\ValidateChargeResponse;
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
     * Generate a standard payment link which displays a payment modal.
     *
     * @param array $data
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     * @throws InvalidRequestDataException
     */
    public function standardPayment(array $data): array {
        $this->validateRequestData(StandardPaymentValidator::class, $data);

        $standardPaymentRequest = (new StandardPaymentRequest('', $data));

        $response = $this->authenticatedHttpClient->post($standardPaymentRequest);

        $standardPaymentResponse = new StandardPaymentResponse($response);

        return $standardPaymentResponse->getResponse();
    }

    /**
     * Verify the success status of a transaction based on the returned id.
     *
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
     * Refund a transaction, identified by id returned from related successful transaction.
     *
     * @param string $transactionId
     * @param int $amount
     * @return Refund
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function refundTransaction(string $transactionId, int $amount): Refund {
        $url = $this->baseUrl . TransactionRefundRequest::URI;

        $refundTransactionRequest = new TransactionRefundRequest($transactionId, $url, $amount);

        $response = $this->authenticatedHttpClient->post($refundTransactionRequest);

        $refundTransactionResponse = new TransactionRefundResponse($response);

        return $refundTransactionResponse->getRefund();
    }

    /**
     * Verify a given Bank Verification Number.
     *
     * @param string $bvn
     * @return BVN\BVNVerification
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function verifyBVN(string $bvn): BVN\BVNVerification {
        $bvnRequest = (new BVNVerificationRequest($bvn, $this->baseUrl . BVNVerificationRequest::URI));

        $response = $this->authenticatedHttpClient->get($bvnRequest);

        $bvnResponse = new BVNVerificationResponse($response);

        return $bvnResponse->getBVNVerification();
    }

    /**
     * Verify a Nigerian bank account.
     *
     * @param string $bankCode
     * @param string $accountNumber
     * @return array
     * @throws GuzzleException
     * @throws JsonException
     */
    public function verifyBankAccount(string $bankCode, string $accountNumber): array {
        $url = $this->baseUrl . BankAccountVerificationRequest::URI;

        $bankVerificationRequest = (new BankAccountVerificationRequest($url, [
            'account_number' => $accountNumber,
            'account_bank' => $bankCode
        ]));

        $response = $this->authenticatedHttpClient->post($bankVerificationRequest);

        $bankVerificationResponse = new BankAccountVerificationResponse($response);

        return $bankVerificationResponse->getResponse();
    }

    /**
     * Transfer funds from merchant account to a customer's bank account.
     *
     * @param array $transactionData
     * @return Bank\BankTransfer\BankTransfer
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function bankTransfer(array $transactionData): Bank\BankTransfer\BankTransfer {
        $this->validateRequestData(BankTransferValidator::class, $transactionData);

        $url = $this->baseUrl . BankTransferRequest::URI;

        $bankTransferRequest = new BankTransferRequest($url, $transactionData);

        $response = $this->authenticatedHttpClient->post($bankTransferRequest);

        $bankTransferResponse = new BankTransferResponse($response);

        return $bankTransferResponse->getBankTransfer();
    }

    /**
     * Charge a Nigerian bank account. Allow customers to pay using a bank account.
     *
     * @param array $transactionData
     * @return BankAccountCharge
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function chargeBankAccount(array $transactionData): BankAccountCharge {
        $this->validateRequestData(BankAccountChargeValidator::class, $transactionData);

        $url = $this->baseUrl . BankAccountChargeRequest::URI;

        $bankAccountChargeRequest = new BankAccountChargeRequest($url, $transactionData);

        $response = $this->authenticatedHttpClient->post($bankAccountChargeRequest);

        var_dump($response);

        $bankAccountChargeResponse = new BankAccountChargeResponse($response);

        return $bankAccountChargeResponse->getBankAccountCharge();
    }

    /**
     * @param array $transactionData
     * @return array|ChargeCard|Authorization
     * @throws GuzzleException
     * @throws JsonException
     */
    public function chargeCard(array $transactionData) {
        $this->validateRequestData(ChargeCardValidator::class, $transactionData);

        $encryptedData = [
            'client' => encryptTransactionData(array_merge($transactionData, [
                'preauthorize' => false
            ]), getenv('ENCRYPTION_KEY'))
        ];

        $url = $this->baseUrl . ChargeCardRequest::URI;
        $bankAccountChargeRequest = new ChargeCardRequest($url, $encryptedData);

        $response = $this->authenticatedHttpClient->post($bankAccountChargeRequest);

        $chargeCardResponse = new ChargeCardResponse($response);

        return $chargeCardResponse->getChargeCard();
    }

    /**
     * @param string $transactionReference
     * @param string $otp
     * @param string $type
     * @return Transaction
     * @throws GuzzleException
     * @throws JsonException
     */
    public function validateCharge(string $transactionReference, string $otp, string $type): Transaction {
        $data = [
            'flw_ref' => $transactionReference,
            'otp' => $otp,
            'type' => $type
        ];

        $this->validateRequestData(ValidateChargeValidator::class, $data);

        $url = $this->baseUrl = ValidateChargeRequest::URI;
        $validateChargeRequest = new ValidateChargeRequest($url, $data);

        $response = $this->authenticatedHttpClient->post($validateChargeRequest);

        $validateChargeResponse = new ValidateChargeResponse($response);

        return $validateChargeResponse->getValidatedCharge();
    }

    /**
     * Charge a card using a previously saved token.
     *
     * @param string $cardToken
     * @param array $chargeData
     * @return Transaction
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function chargeCardToken(string $cardToken, array $chargeData): Transaction {
        $this->validateRequestData(ChargeCardTokenValidator::class, $chargeData);

        $url = $this->baseUrl . ChargeCardTokenRequest::URI;

        $chargeCardTokenRequest = new ChargeCardTokenRequest($url, array_merge([
            'token' => $cardToken
        ], $chargeData));

        $response = $this->authenticatedHttpClient->post($chargeCardTokenRequest);

        $chargeCardTokenResponse = new ChargeCardTokenResponse($response);

        return $chargeCardTokenResponse->getTransaction();
    }

    /**
     * Use a card token to preauthorize a charge on a given card.
     *
     * @param string $cardToken
     * @param array $chargeData
     * @return Transaction
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function preAuthCardWithToken(string $cardToken, array $chargeData): Transaction {
        $chargeData = array_merge($chargeData, [
            'preauthorize' => true
        ]);

        return $this->chargeCardToken($cardToken, $chargeData);
    }

    /**
     * Collect preauthorized funds on a given card.
     *
     * @param string $flwRef
     * @param string $amount
     * @return Transaction
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function capturePreAuthCharge(string $flwRef, string $amount): Transaction {
        $requestData = [
            'amount' => $amount
        ];

        $url = $this->baseUrl . ChargePreAuthCardRequest::URI;

        $preAuthRequest = new ChargePreAuthCardRequest($flwRef, $url, $requestData);

        $response = $this->authenticatedHttpClient->post($preAuthRequest);

        $preAuthResponse = new ChargePreAuthCardResponse($response);

        return $preAuthResponse->getTransaction();
    }

    /**
     * Cancel or release the hold on a preauthorized charge.
     *
     * @param string $flwRef
     * @return Transaction
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function cancelPreAuthCard(string $flwRef): Transaction {
        $url = $this->baseUrl . CancelPreAuthRequest::URI;

        $cancelRequest = new CancelPreAuthRequest($flwRef, $url);

        $response = $this->authenticatedHttpClient->post($cancelRequest);

        $cancelResponse = new CancelPreAuthResponse($response);

        return $cancelResponse->getTransaction();
    }

    /**
     * Return a captured amount from a previously preauthorized charge.
     *
     * @param string $flwRef
     * @param string $amount
     * @return Transaction
     * @throws GuzzleException
     * @throws JsonException
     * @throws ReflectionException
     */
    public function refundPreAuthCharge(string $flwRef, string $amount): Transaction {
        $url = $this->baseUrl . RefundPreAuthChargeRequest::URI;

        $refundRequest = new RefundPreAuthChargeRequest($url, $flwRef, $amount);

        $response = $this->authenticatedHttpClient->post($refundRequest);

        $refundResponse = new RefundPreAuthChargeResponse($response);

        return $refundResponse->getTransaction();
    }

    /**
     * Validate request data based on a provided validator class.
     *
     * @param string $validator
     * @param array $requestData
     */
    private function validateRequestData(string $validator, array $requestData): void {
        $validatorInstance = (new $validator($requestData))->validate();
        if (!$validatorInstance->isValid()) {
            throw new InvalidRequestDataException($validatorInstance->getErrors());
        }
    }
}
