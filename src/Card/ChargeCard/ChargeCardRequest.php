<?php

namespace ChrisIdakwo\Flutterwave\Card\ChargeCard;

use ChrisIdakwo\Flutterwave\Http\Request\HttpPostRequest;

class ChargeCardRequest extends HttpPostRequest {
    public const URI = '/charges/?type=card';
}
