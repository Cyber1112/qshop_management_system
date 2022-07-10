<?php

namespace App\Contracts;

use App\Dto\Business\BusinessContacts\CreateDto;
use App\Models\BusinessContacts;

interface UpdateBusinessContacts{

    public function execute(CreateDto $dto, BusinessContacts $businessContacts): void;

}
