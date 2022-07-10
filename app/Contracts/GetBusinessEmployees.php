<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetBusinessEmployees{

    public function execute(): Collection;

}
