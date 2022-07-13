<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface ApiGetCardBalanceHistory{

    public function execute(): Collection;

}
