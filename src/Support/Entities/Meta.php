<?php

namespace ChrisIdakwo\Flutterwave\Support\Entities;

class Meta extends Entity {
    public ?Authorization $authorization;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $email;
    public ?string $mobileNumber;
}
