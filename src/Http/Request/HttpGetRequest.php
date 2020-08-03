<?php

namespace ChrisIdakwo\Flutterwave\Http\Request;

interface HttpGetRequest {

    /**
     * Returns the URL for the GET request.
     *
     * @return string
     */
    public function getUrl(): string;
}
