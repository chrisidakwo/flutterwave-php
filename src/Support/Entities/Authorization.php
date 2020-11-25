<?php

namespace ChrisIdakwo\Flutterwave\Support\Entities;

class Authorization extends Entity {
    public ?string $mode;
    public ?array $fields;
    public ?string $redirect;
    public ?string $validate_instructions;
    public ?string $pin;
    public ?string $address;
    public ?string $city;
    public ?string $state;
    public ?string $zipcode;
    public ?string $country;

}
