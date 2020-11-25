<?php

namespace ChrisIdakwo\Flutterwave\Bank\BankAccountCharge;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class BankAccountChargeRequest extends HttpPostRequest {
	public const URI = '/charges?type=debit_ng_account';
}
