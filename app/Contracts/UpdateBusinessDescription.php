<?php

namespace App\Contracts;

use App\Models\BusinessDescription;

interface UpdateBusinessDescription{

    public function execute(string $description, BusinessDescription $businessDescription): void;

}
