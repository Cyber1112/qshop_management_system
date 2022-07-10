<?php

namespace App\Contracts;


use Illuminate\Support\Collection;

interface GetBusinessCategories{

    public function execute(): Collection;

}
