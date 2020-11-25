<?php

namespace ChrisIdakwo\Flutterwave\BVN;

use ChrisIdakwo\Flutterwave\Support\Entities\Entity;

class BVNVerification extends Entity {
    public string $bvn;
    public string $firstName;
    public string $middleName;
    public string $lastName;
    public string $dateOfBirth;
    public string $phoneNumber;
    public string $gender;
}
