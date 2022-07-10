<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetBusinessClients{

    public function execute(): Collection;

}
