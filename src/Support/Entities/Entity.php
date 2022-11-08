<?php

namespace ChrisIdakwo\Flutterwave\Support\Entities;

use ChrisIdakwo\Flutterwave\Support\Str;
use JsonException;
use ReflectionClass;

class Entity {
    /**
     * Entity constructor.
     *
     * @param array $properties
     */
    public function __construct(array $properties) {
        $reflectionClass = new ReflectionClass($this);
        $classProperties = $reflectionClass->getProperties();

        foreach ($classProperties as $classProperty) {
            $value = $properties[Str::toSnakeCase($classProperty->getName())] ?? null;

            // Should have used this: https://stackoverflow.com/a/1869569/2484914
            if (is_array($value)) {
                $value = (object) $value;
            }

            $this->{$classProperty->getName()} = $value;
        }
    }

    /**
     * @return array
     * @throws JsonException
     */
    public function toArray(): array {
        return json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
    }
}
