<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetClientTransactionsHistory{

    public function execute(string $from, string $to): Collection;

}
