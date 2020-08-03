<?php

namespace ChrisIdakwo\Flutterwave\Support;

use Dotenv\Dotenv;
use ReflectionClass;
use ReflectionException;

class Environment {
	public const ENV_TEST = 'test';
	public const ENV_LIVE = 'live';

	protected string $secretKey;
	protected string $publicKey;
	protected string $encryptionKey;
	protected string $redirectUrl;
	protected string $webhookUrl;
	protected string $webhookFailedTransUrl;
	protected string $webHookSecretHash;
	protected string $baseUrl;

	/**
	 * Environment constructor.
	 * @param string|null $environment
	 * @throws ReflectionException
	 */
	public function __construct(string $environment = null) {
		$this->setup($environment);
	}

	/**
	 * @param string|null $environment
	 * @throws ReflectionException
	 */
	private function setup(string $environment = null): void {
		// Load environment file
		if (!getenv('RAVE_ENV')) {
			Dotenv::createImmutable(__DIR__ . '/../../')->load();
		}

		/**
		 * Resolve class attributes based on current environment
		 */
		$raveEnv = $environment ?: getenv('RAVE_ENV');
		$properties = (new ReflectionClass($this))->getProperties();

		// Set the environment name in uppercase. If the environment name is not live,
		// then use the value self::ENV_TEST as the environment name
		$raveEnv = ($raveEnv !== self::ENV_LIVE) ? strtoupper(self::ENV_TEST) : strtoupper($raveEnv);

		foreach ($properties as $property) {
			$propertyName = $property->getName();

			// set environment variable key using the environment name as the prefix
			$environmentKey =  strtoupper($raveEnv . '_' . Str::toSnakeCase($propertyName));

			// Get environment value and set to class property
			$this->{$propertyName} = getenv($environmentKey);
		}
	}

	/**
	 * @return string
	 */
	public function getSecretKey(): string {
		return $this->secretKey;
	}

	/**
	 * @return string
	 */
	public function getPublicKey(): string {
		return $this->publicKey;
	}

	/**
	 * @return string
	 */
	public function getEncryptionKey(): string {
		return $this->encryptionKey;
	}

	/**
	 * @return string
	 */
	public function getRedirectUrl(): string {
		return $this->redirectUrl;
	}

	/**
	 * @return string
	 */
	public function getWebHookUrl(): string {
		return $this->webhookUrl;
	}

	/**
	 * @return string
	 */
	public function getWebHookFailedTransUrl(): string {
		return $this->webhookFailedTransUrl;
	}

	/**
	 * @return string
	 */
	public function getWebHookSecretHash(): string {
		return $this->webHookSecretHash;
	}

	/**
	 * @return string
	 */
	public function getBaseUrl(): string {
		return $this->baseUrl;
	}
}
