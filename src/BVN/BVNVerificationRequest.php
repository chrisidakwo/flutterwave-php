<?php

namespace ChrisIdakwo\Flutterwave\BVN;

use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpGetRequest;

class BVNVerificationRequest implements HttpGetRequest {
	public const URI = '/kyc/bvns/{number}';

	public string $url;
	public string $bvn;

	/**
	 * BVNVerificationRequest constructor.
	 *
	 * @param string $bvn
	 * @param string $url
	 */
	public function __construct(string $bvn, string $url) {
		$this->url = $url;
		$this->bvn = $bvn;
	}

	/**
	 * @inheritDoc
	 */
	public function getUrl(): string {
		return str_replace('{number}', $this->bvn, $this->url);
	}
}
