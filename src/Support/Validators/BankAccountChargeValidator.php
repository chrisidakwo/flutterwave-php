<?php

namespace ChrisIdakwo\Flutterwave\Support\Validators;

use Respect\Validation\Validator as v;

class BankAccountChargeValidator extends Validator {
	public function buildValidator(): v {
		return $this->validator::arrayType()->key('tx_ref', v::stringVal()->notEmpty())
			->key('amount', v::numericVal()->notEmpty())
			->key('account_bank', v::stringVal()->notEmpty())
			->Key('account_number', v::stringVal()->notEmpty())
			->key('currency', v::stringVal()->notEmpty())
			->key('email', v::stringVal()->notEmpty())
			->key('bvn', v::stringVal()->notEmpty(), false)
			->key('phone_number', v::numericVal()->notEmpty(), false)
			->key('client_ip', v::stringVal()->notEmpty(), false)
			->key('device_fingerprint', v::stringVal()->notEmpty(), false)
			->key('meta', v::arrayVal()->notEmpty(), false)
			->key('fullname', v::stringVal()->notEmpty(), false)
			->key('passcode', v::stringVal()->notEmpty(), false);
	}
}
