<?php

namespace ChrisIdakwo\Flutterwave\Support\Entities;

class Card extends Entity {
    public string $first_6digits;
    public string $last_4digits;
    public string $issuer;
    public string $country;
    public string $type;
    public string $expiry;
}
