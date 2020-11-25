<?php

namespace ChrisIdakwo\Flutterwave\Bank\BankTransfer;

use ChrisIdakwo\Flutterwave\Support\Entities\Entity;

class BankTransfer extends Entity {
    public int $id;
    public string $accountNumber;
    public string $bankCode;
    public string $fullName;
    public string $createdAt;
    public string $currency;
    public string $debitCurrency;
    public float $amount;
    public float $fee;
    public string $status;
    public string $reference;
    public ?object $meta;
    public string $narration;
    public string $completeMessage;
    public int $requiredApproval;
    public int $isApproved;
    public string $bankName;
}
