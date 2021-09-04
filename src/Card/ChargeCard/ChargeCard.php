<?php

namespace ChrisIdakwo\Flutterwave\Card\ChargeCard;

use ChrisIdakwo\Flutterwave\Support\Entities\Card;
use ChrisIdakwo\Flutterwave\Support\Entities\Customer;
use ChrisIdakwo\Flutterwave\Support\Entities\Entity;
use ChrisIdakwo\Flutterwave\Support\Entities\Meta;

class ChargeCard extends Entity {
    public string $id;
    public string $txRef;
    public string $flwRef;
    public string $deviceFingerprint;
    public string $amount;
    public string $chargedAmount;
    public string $appFee;
    public string $merchantFee;
    public ?string $processorResponse;
    public string $authModel;
    public string $currency;
    public string $ip;
    public string $narration;
    public string $status;
    public string $authUrl;
    public string $paymentType;
    public string $fraudStatus;
    public string $chargeType;
    public string $createdAt;
    public string $accountId;
    public Customer $customer;
    public Card $card;
    public Meta $meta;
}
