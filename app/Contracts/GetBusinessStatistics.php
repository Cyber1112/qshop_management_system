<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetBusinessStatistics{

    public function execute(string $period): Collection;

}
