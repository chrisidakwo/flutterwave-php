<?php

namespace ChrisIdakwo\Flutterwave\VerifyTransaction;

use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpGetRequest;

class VerifyTransactionRequest implements HttpGetRequest {
	public const URI = '/transactions/{id}/verify';

	public string $url;
	public string $transactionId;

	public function __construct(string $transactionId, string $url) {
		$this->url = $url;
		$this->transactionId = $transactionId;
	}

	/**
	 * @inheritDoc
	 */
	public function getUrl(): string {
		return str_replace('{id}', $this->transactionId, $this->url);
	}
}
