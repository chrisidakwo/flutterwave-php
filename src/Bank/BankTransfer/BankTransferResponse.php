<?php

namespace ChrisIdakwo\Flutterwave\Bank\BankTransfer;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use JsonException;
use ReflectionException;

class BankTransferResponse extends HttpResponse {
	/**
	 * @return BankTransfer
	 * @throws JsonException
	 * @throws ReflectionException
	 */
	public function getBankTransfer(): BankTransfer {
		return new BankTransfer($this->getResponse()['data']);
	}
}
