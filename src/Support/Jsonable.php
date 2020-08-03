<?php

namespace ChrisIdakwo\Flutterwave\Support;

use ReflectionClass;

class Jsonable implements \JsonSerializable {

	/**
	 * @return array
	 * @throws \ReflectionException
	 */
	public function toArray() {
		$reflectionClass = (new ReflectionClass($this));
		$properties = $reflectionClass->getProperties();

		$array = [];
		foreach ($properties as $property) {
			if ($property->isStatic()) {
				$array[$property->getName()] = $reflectionClass->getDefaultProperties()[$property->getName()];
			} else {
				$array[$property->getName()] = $property->getValue($this);
			}
		}

		return $array;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize() {

	}
}
