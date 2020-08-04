<?php

namespace ChrisIdakwo\Flutterwave\Transaction;

use ChrisIdakwo\Flutterwave\Support\Entity;

class Transaction extends Entity {
    public int $id;
    public string $txRef;
    public ?string $deviceFingerprint;
    public float $amount;
    public string $currency;
    public float $chargedAmount;
    public float $appFee;
    public float $merchantFee;
    public string $processorResponse;
    public string $authModel;
    public string $ip;
    public string $narration;
    public string $status;
    public string $paymentType;
    public string $createdAt;
    public string $accountId;
    public string $amountSettled;
    public ?object $card;
    public ?object $account;
    public object $customer;
}
