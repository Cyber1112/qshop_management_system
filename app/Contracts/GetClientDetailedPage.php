<?php

namespace App\Contracts;

use App\Models\Client;
use Illuminate\Support\Collection;

interface GetClientDetailedPage{

    public function execute(Client $client, string $from, string $to): Collection;

}
