<?php

namespace ChrisIdakwo\Flutterwave\Support\Validators;

use Respect\Validation\Validator as v;

class ChargeCardTokenValidator extends Validator {
    public function buildValidator(): v {
        return $this->validator::arrayType()->key('currency', v::stringVal()->notEmpty())
            ->key('country', v::stringVal()->notEmpty())
            ->key('amount', v::stringVal()->notEmpty())
            ->key('tx_ref', v::stringVal()->notEmpty())
            ->key('email', v::stringVal()->notEmpty())
            ->key('first_name', v::stringVal()->notEmpty(), false)
            ->key('last_name', v::stringVal()->notEmpty(), false)
            ->key('narration', v::stringVal()->notEmpty(), false)
            ->key('device_fingerprint', v::stringVal()->notEmpty(), false)
            ->key('subaccounts', v::arrayType()->notEmpty(), false)
            ->key('preauthorize', v::boolType(), false);
    }
}
