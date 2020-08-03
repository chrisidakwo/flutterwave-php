<?php

namespace ChrisIdakwo\Flutterwave\Http\Request;

use ChrisIdakwo\Flutterwave\Http\Request\Contracts\HttpPostRequest as HttpPostRequestContract;

abstract class HttpPostRequest implements HttpPostRequestContract {
	public string $url;
	protected ?array $data;

	public function __construct(string $url, $data = []) {
		$this->url = $url;
		$this->setBody($data);
	}

	/**
	 * @inheritDoc
	 */
	public function setBody(array $data = []): self {
		$this->data = $data;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getBody(): string {
		if (empty($this->data)) {
			return '';
		}

		return json_encode($this->data, JSON_THROW_ON_ERROR);
	}
}
