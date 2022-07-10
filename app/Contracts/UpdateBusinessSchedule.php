<?php

namespace App\Contracts;

use App\Dto\Business\BusinessSchedule\CreateDto;
use App\Models\BusinessSchedule;

interface UpdateBusinessSchedule{

    public function execute(CreateDto $dto, BusinessSchedule $schedule): void;

}
