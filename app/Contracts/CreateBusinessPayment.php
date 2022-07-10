<?php

namespace App\Contracts;

use App\Dto\Business\BusinessPayment\CreateDto;

interface CreateBusinessPayment{

    public function execute(CreateDto $dto): void;

}
