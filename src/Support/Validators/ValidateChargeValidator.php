<?php

namespace ChrisIdakwo\Flutterwave\Support\Validators;

use Respect\Validation\Validator as v;

class ValidateChargeValidator extends Validator {
    public function buildValidator(): v {
        $this->validator::arrayType()
            ->key('tx_ref', v::stringVal()->notEmpty())
            ->key('otp', v::stringVal()->notEmpty())
            ->key('type', v::stringVal()->containsAny(['card', 'account']));
    }
}
