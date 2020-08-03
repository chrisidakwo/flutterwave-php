<?php

namespace ChrisIdakwo\Flutterwave\Tests;

use ChrisIdakwo\Flutterwave\Entity;

class EntityTest extends TestCase {
    public function testEntityCanBeConvertedToArray() {
        $data = [
            'id' => 3434535,
            'amount' => 345400,
            'text' => 'ertyew43t32424',
            'customer' => [
                'name' => 'Chris',
                'phone' => '1234'
            ],
        ];

        // Initiate new class
        $class = new class($data) extends Entity {
            public string $id;
            public float $amount;
            public string $text;
            public object $customer;
        };

        $isArray = is_array($class->toArray());
        self::assertTrue($isArray);

        $isArray = is_array($class->toArray()['customer']);
        self::assertTrue($isArray);

        self::assertArrayHasKey('name', $class->toArray()['customer']);
        self::assertArrayHasKey('phone', $class->toArray()['customer']);
    }
}
