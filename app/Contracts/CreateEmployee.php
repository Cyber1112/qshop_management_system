<?php

namespace App\Contracts;

use App\Dto\Business\BusinessEmployee\CreateDto;

interface CreateEmployee{

    public function execute(CreateDto $dto): void;

}
