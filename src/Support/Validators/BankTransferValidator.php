<?php

namespace ChrisIdakwo\Flutterwave\Support\Validators;

use Respect\Validation\Validator as v;

class BankTransferValidator extends Validator {
    public function buildValidator(): v {
        return $this->validator::arrayType()->key('amount', v::numericVal()->notEmpty())
            ->key('account_bank', v::stringVal()->notEmpty())
            ->Key('account_number', v::stringVal()->notEmpty())
            ->key('currency', v::stringVal()->notEmpty())
            ->key('beneficiary_name', v::stringVal()->notEmpty())
            ->key('narration', v::stringVal()->notEmpty(), false)
            ->key('destination_branch_code', v::stringVal()->notEmpty(), false)
            ->key('beneficiary', v::numericVal()->notEmpty(), false)
            ->key('reference', v::stringVal()->notEmpty(), false)
            ->key('callback_url', v::stringVal()->notEmpty(), false)
            ->key('debit_currency', v::stringVal()->notEmpty(), false)
            ->key('meta', v::arrayVal()->notEmpty(), false)
            ->keyNested('meta.first_name', v::stringVal()->notEmpty(), false)
            ->keyNested('meta.last_name', v::stringVal()->notEmpty(), false)
            ->keyNested('meta.email', v::stringVal()->email(), false)
            ->keyNested('meta.mobile_number', v::stringVal()->notEmpty(), false);
    }
}
