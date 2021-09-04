<?php

namespace ChrisIdakwo\Flutterwave\ValidateCharge;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class ValidateChargeRequest extends HttpPostRequest {
    public const URI = '/validate-charge';
}
