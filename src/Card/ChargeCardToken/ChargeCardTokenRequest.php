<?php

namespace ChrisIdakwo\Flutterwave\Card\ChargeCardToken;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class ChargeCardTokenRequest extends HttpPostRequest {
    public const URI = '/tokenized-charges';
}
