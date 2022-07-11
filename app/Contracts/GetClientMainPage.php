<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

interface GetClientMainPage{

    public function execute(): Collection;

}
