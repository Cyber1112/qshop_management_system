<?php

namespace App\Contracts;

use App\Dto\Business\BusinessSchedule\CreateDto;

interface CreateBusinessSchedule{

    public function execute(CreateDto $dto): void;

}
