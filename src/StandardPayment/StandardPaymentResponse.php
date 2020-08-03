<?php

namespace ChrisIdakwo\Flutterwave\StandardPayment;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use JsonException;

class StandardPaymentResponse extends HttpResponse {
	/**
	 * @return string
	 * @throws JsonException
	 */
	public function getPaymentLink(): string {
		$responseArray = $this->getResponse();

		if (!array_key_exists('data', $responseArray)) {
			return '';
		}

        return $responseArray['data']['link'];
    }
}
