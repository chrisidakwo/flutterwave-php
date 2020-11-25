<?php

declare(strict_types=1);

if (!function_exists('encryptTransactionData')) {
    /**
     * @param array $data
     * @param string $key
     * @return string
     */
    function encryptTransactionData(array $data, string $key): string {
        $data = \GuzzleHttp\json_encode($data);

        $encData = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);

        return base64_encode($encData);
    }
}
