<?php

namespace App\Contracts;

interface UpdateCity{

    public function execute(int $city_id): void;

}
