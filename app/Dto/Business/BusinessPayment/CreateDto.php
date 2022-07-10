<?php

namespace App\Dto\Business\BusinessPayment;

use Spatie\DataTransferObject\DataTransferObject;

class CreateDto extends DataTransferObject {
    public string $phone_number;
    public int $bonus_percent;
    public int $cash;
    public string $task;
    public string|null $comment;
}

