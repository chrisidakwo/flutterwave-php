<?php

namespace ChrisIdakwo\Flutterwave\Transaction\Refund;

use ChrisIdakwo\Flutterwave\Support\Entities\Entity;

class Refund extends Entity {
    public int $id;
    public int $accountId;
    public int $txId;
    public int $walletId;
    public string $flwRef;
    public float $amountRefunded;
    public string $status;
    public string $destination;
    public ?object $meta;
    public string $createdAt;
}
