<?php

namespace ChrisIdakwo\Flutterwave\Card\CapturePreAuthCharge;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class ChargePreAuthCardRequest extends HttpPostRequest {
	public const URI = '/charges/{FLW_REF}/capture';
	private string $flutterwaveRef;

	/**
	 * ChargePreAuthCardRequest constructor.
	 *
	 * @param string $flutterwaveRef
	 * @param string $url
	 * @param array $data
	 */
	public function __construct(string $flutterwaveRef, string $url, array $data = []) {
		$this->flutterwaveRef = $flutterwaveRef;

		parent::__construct($url, $data);
	}

	/**
	 * @inheritDoc
	 */
	public function getUrl(): string {
		return str_replace('{FLW_REF}', $this->flutterwaveRef, $this->url);
	}
}
