<?php

namespace ChrisIdakwo\Flutterwave\Bank\BankTransfer;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class BankTransferRequest extends HttpPostRequest {
	public const URI = '/transfers';
}
