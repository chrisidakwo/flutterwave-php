<?php

namespace ChrisIdakwo\Flutterwave\Support\Validators;

use Respect\Validation\Validator as v;

class ChargeCardValidator extends Validator {
    public function buildValidator(): v {
        return $this->validator::arrayType()->key('tx_ref', v::stringVal()->notEmpty())
            ->key('amount', v::numericVal()->notEmpty())
            ->key('currency', v::stringType()->stringVal()->notEmpty())
            ->key('card_number', v::number()->numericVal()->notEmpty())
            ->key('cvv', v::number()->numericVal()->notEmpty())
            ->key('expiry_month', v::number()->numericVal()->min(1)->max(12)->notEmpty())
            ->key('expiry_year', v::number()->numericVal()->length(2, 2)->notEmpty())
            ->key('email', v::stringVal()->email()->notEmpty())
            ->key('phone_number', v::numericVal()->notEmpty(), false)
            ->key('fullname', v::stringVal()->notEmpty(), false)
            ->key('redirect_url', v::stringVal()->notEmpty(), false)
            ->key('client_ip', v::stringVal()->notEmpty(), false)
            ->key('device_fingerprint', v::stringVal()->notEmpty(), false)
            ->key('meta', v::arrayVal()->notEmpty(), false)
            ->key('authorization', v::arrayVal()->notEmpty(), false)
            ->keyNested('authorization.mode', v::stringType()->stringVal()->notEmpty(), false)
            ->keyNested('authorization.pin', v::number()->numericVal()->notEmpty(), false)
            ->keyNested('authorization.city', v::stringType()->stringVal()->notEmpty(), false)
            ->keyNested('authorization.address', v::stringType()->stringVal()->notEmpty(), false)
            ->keyNested('authorization.state', v::stringType()->stringVal()->notEmpty(), false)
            ->keyNested('authorization.country', v::stringType()->stringVal()->notEmpty(), false)
            ->keyNested('authorization.zipcode', v::stringType()->stringVal()->notEmpty(), false)
            ->key('payment_plan', v::stringType()->stringVal()->notEmpty(), false);
    }
}
