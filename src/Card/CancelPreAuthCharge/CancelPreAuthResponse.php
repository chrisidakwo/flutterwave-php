<?php

namespace ChrisIdakwo\Flutterwave\Card\CancelPreAuthCharge;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use ChrisIdakwo\Flutterwave\Transaction\Transaction;
use JsonException;
use ReflectionException;

class CancelPreAuthResponse extends HttpResponse {
	/**
	 * @return Transaction
	 * @throws JsonException
	 * @throws ReflectionException
	 */
	public function getTransaction(): Transaction {
		return new Transaction($this->getResponse()['data']);
	}
}
