<?php

namespace ChrisIdakwo\Flutterwave\Bank\BankAccountVerification;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class BankAccountVerificationRequest extends HttpPostRequest {
    public const URI = '/accounts/resolve';
}
