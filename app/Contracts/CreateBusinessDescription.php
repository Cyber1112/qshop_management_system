<?php

namespace App\Contracts;

interface CreateBusinessDescription{

    public function execute(string $description): void;

}
