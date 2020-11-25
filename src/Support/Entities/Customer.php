<?php

namespace ChrisIdakwo\Flutterwave\Support\Entities;

class Customer extends Entity {
    public string $id;
    public ?string $phone_number;
    public string $email;
    public string $created_at;
}
