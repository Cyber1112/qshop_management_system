<?php

namespace App\Contracts;

use App\Dto\Business\BusinessWithdrawal\CreateDto;

interface CreateBusinessWithdrawal{

    public function execute(CreateDto $dto): void;

}
