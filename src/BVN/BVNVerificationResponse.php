<?php

namespace ChrisIdakwo\Flutterwave\BVN;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use JsonException;
use ReflectionException;

class BVNVerificationResponse extends HttpResponse {
    /**
     * @return BVNVerification
     * @throws JsonException
     * @throws ReflectionException
     */
    public function getBVNVerification(): BVNVerification {
        $response = $this->getResponse()['data'];

        $payload = [
            'bvn' => $response['bvn'],
            'first_name' => $response['first_name'],
            'middle_name' => $response['middle_name'],
            'last_name' => $response['last_name'],
            'date_of_birth' => $response['date_of_birth'],
            'phone_number' => $response['phone_number'],
            'gender' => $response['gender']
        ];

        return new BVNVerification($payload);
    }
}
