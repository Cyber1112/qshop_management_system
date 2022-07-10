<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetAllTransactionsHistoryBetweenDate{

    public function execute(string $from, string $to): Collection;

}
