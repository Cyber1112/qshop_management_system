<?php

namespace App\Contracts;

use App\Dto\Business\BusinessContacts\CreateDto;

interface CreateBusinessContacts{

    public function execute(CreateDto $dto): void;

}
