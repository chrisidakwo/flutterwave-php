<?php

namespace ChrisIdakwo\Flutterwave\StandardPayment;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use JsonException;

class StandardPaymentResponse implements HttpResponse {

	private string $response;

	public function __construct(string $response) {
		$this->response = $response;
	}

	/**
	 * @inheritDoc
	 */
	public function getResponse(): array {
		return (array) json_decode($this->response, true, 512, JSON_THROW_ON_ERROR);
	}

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
