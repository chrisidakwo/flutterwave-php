<?php

namespace ChrisIdakwo\Flutterwave\Support;

class Str {
	/**
	 * See: https://stackoverflow.com/a/1993772/2484914
	 *
	 * @param string $string
	 * @return string
	 */
	public static function toSnakeCase(string $string): string {
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $matches);
		$ret = $matches[0];
		foreach ($ret as &$match) {
			$match = $match === strtoupper($match) ? strtolower($match) : lcfirst($match);
		}
		return implode('_', $ret);
	}
}
