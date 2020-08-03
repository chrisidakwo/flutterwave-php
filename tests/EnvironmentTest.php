<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use ChrisIdakwo\Flutterwave\Support\Environment;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase {
    public function testEnvironmentPropertiesAreProperlyLoaded(): void {
        $environment = new Environment(Environment::ENV_LIVE);

        self::assertSame($environment->getBaseUrl(), getenv('LIVE_BASE_URL'));
        self::assertSame($environment->getSecretKey(), getenv('LIVE_SECRET_KEY'));
    }
}
