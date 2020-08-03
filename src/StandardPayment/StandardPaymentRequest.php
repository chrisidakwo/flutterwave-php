<?php

namespace ChrisIdakwo\Flutterwave\StandardPayment;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class StandardPaymentRequest extends HttpPostRequest {
	public const URI = 'https://api.flutterwave.com/v3/payments';

	/**
	 * @inheritDoc
	 */
	public function getUrl(): string {
		return self::URI;
	}
}
