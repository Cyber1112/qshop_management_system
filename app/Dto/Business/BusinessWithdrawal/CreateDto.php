<?php

namespace App\Dto\Business\BusinessWithdrawal;

use Spatie\DataTransferObject\DataTransferObject;

class CreateDto extends DataTransferObject {
    public string $phone_number;
    public int $cash;
    public string $task;
    public string|null $comment;
}

