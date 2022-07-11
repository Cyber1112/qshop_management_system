<?php

namespace App\Contracts;


use Illuminate\Support\Collection;

interface GetClientUnactivatedBonus{

    public function execute(): Collection;

}
