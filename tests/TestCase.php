<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use ChrisIdakwo\Flutterwave\Exceptions\InvalidSecretKey;
use ChrisIdakwo\Flutterwave\Rave;
use ChrisIdakwo\Flutterwave\Support\Environment;

abstract class TestCase extends \PHPUnit\Framework\TestCase {
    public Environment $environment;
    protected Rave $rave;

    /**
     * @inheritDoc
     * @throws InvalidSecretKey
     */
    protected function setUp(): void {
        parent::setUp();

        $this->environment = new Environment(Environment::ENV_TEST);

        $secretToken = $this->environment->getSecretKey();
        $baseUrl = $this->environment->getBaseUrl();

        $this->rave = new Rave($secretToken, $baseUrl);
    }
}
