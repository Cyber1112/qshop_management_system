<?php

namespace App\Dto\Business\BusinessEmployee;

use Spatie\DataTransferObject\DataTransferObject;

class CreateDto extends DataTransferObject {
    public string $phone_number;
    public string $name;
    public string $position;
    public string $password;
    public array $permissions;
}
