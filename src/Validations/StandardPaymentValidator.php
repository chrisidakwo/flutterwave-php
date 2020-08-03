<?php

namespace ChrisIdakwo\Flutterwave\Validations;

use Respect\Validation\Validator as v;

class StandardPaymentValidator extends Validator {
    public function buildValidator(): v {
        return $this->validator::arrayType()->key('tx_ref', v::stringVal()->notEmpty(), true)
            ->key('amount', v::numericVal())
            ->key('payment_options', v::stringVal()->notEmpty())
            ->key('redirect_url', v::stringVal()->url())
            ->key('customer', v::arrayVal())
            ->keyNested('customer.name', v::stringVal()->notEmpty())
            ->keyNested('customer.email', v::stringVal()->email())
            ->keyNested('customer.phonenumber', v::stringVal()->notEmpty())
            ->key('customizations', v::arrayVal())
            ->keyNested('customizations.title', v::stringVal()->notEmpty())
            ->keyNested('customizations.description', v::stringVal()->notEmpty())
            ->keyNested('customizations.logo', v::stringVal()->notEmpty());
    }
}
