<?php

namespace App\Contracts;

use App\Dto\Business\BusinessBonusOption\CreateDto;

interface CreateBusinessBonusOption{

    public function execute(CreateDto $dto): void;

}
