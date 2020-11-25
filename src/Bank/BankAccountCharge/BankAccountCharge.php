<?php

namespace ChrisIdakwo\Flutterwave\Bank\BankAccountCharge;

use ChrisIdakwo\Flutterwave\Support\Entity;

class BankAccountCharge extends Entity {
	public string $id;
	public string $txRef;
	public string $flwRef;
	public string $deviceFingerprint;
	public string $amount;
	public string $chargedAmount;
	public string $appFee;
	public string $merchantFee;
	public string $authModel;
	public string $currency;
	public string $ip;
	public string $narration;
	public string $status;
	public string $authUrl;
	public string $paymentType;
	public string $fraudStatus;
	public string $createdAt;
	public string $accountId;
	public object $customer;
	public object $account;
	public object $meta;
}
