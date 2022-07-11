<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetClientPartners{

    public function execute(): Collection;

}
