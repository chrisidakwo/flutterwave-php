<?php

namespace ChrisIdakwo\Flutterwave\Card\ChargeCard;

use ChrisIdakwo\Flutterwave\Http\Response\HttpResponse;
use ChrisIdakwo\Flutterwave\Support\Entities\Authorization;
use ChrisIdakwo\Flutterwave\Support\Entities\Card;
use ChrisIdakwo\Flutterwave\Support\Entities\Customer;
use ChrisIdakwo\Flutterwave\Support\Entities\Meta;
use JsonException;

class ChargeCardResponse extends HttpResponse {

    public const MESSAGE_AUTHORIZATION_REQUIRED = 'Charge authorization data required';
    public const MESSAGE_CHARGE_INITIATED = 'Charge initiated';

    /**
     * @return array|ChargeCard|Authorization
     * @throws JsonException
     */
    public function getChargeCard() {
        $response = $this->getResponse();

        if ($response['message'] === ChargeCardResponse::MESSAGE_AUTHORIZATION_REQUIRED) {
            $authorization = $response['meta']['authorization'];
            $fields = $authorization['fields'];

            unset($authorization['fields']);

            $authorization = new Authorization($authorization);
            $authorization->fields = $fields;

            return $authorization;
        }

        if ($response['message'] === ChargeCardResponse::MESSAGE_CHARGE_INITIATED) {
            $data = $this->getResponse()['data'];
            $card = $data['card'];
            $meta = $data['meta'];
            $customer = $data['customer'];

            // Remove the card and customer from array
            unset($data['card'], $data['meta'], $data['customer']);

            $chargeCard = new ChargeCard($data);
            $chargeCard->card = new Card($card);
            $chargeCard->meta = new Meta($meta);
            $chargeCard->customer = new Customer($customer);

            return $chargeCard;
        }

        return $response;
    }
}
