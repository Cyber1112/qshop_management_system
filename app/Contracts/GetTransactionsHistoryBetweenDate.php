<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetTransactionsHistoryBetweenDate{

    public function execute(string $from, string $to): Collection;

}
