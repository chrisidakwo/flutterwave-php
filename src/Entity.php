<?php

namespace ChrisIdakwo\Flutterwave;

use ChrisIdakwo\Flutterwave\Support\Str;
use ReflectionClass;
use ReflectionException;

class Entity {
	/**
	 * Entity constructor.
	 *
	 * @param array $properties
	 * @throws ReflectionException
	 */
	public function __construct(array $properties) {
		$reflectionClass = new ReflectionClass($this);
		$classProperties = $reflectionClass->getProperties();

		foreach ($classProperties as $classProperty) {
			$value = $properties[Str::toSnakeCase($classProperty->getName())] ?? null;

			if (is_array($value)) {
				$value = (object)$value;
			}

			$this->{$classProperty->getName()} = $value;
		}
	}
}
