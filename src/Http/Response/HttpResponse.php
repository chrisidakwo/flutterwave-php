<?php

namespace ChrisIdakwo\Flutterwave\Http\Response;

use JsonException;

interface HttpResponse {
    /**
     * @return array
     * @throws JsonException
     */
    public function getResponse(): array;
}
