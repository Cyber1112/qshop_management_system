<?php

namespace App\Contracts;

interface Login{

    /**
     * @param string $phone_number
     * @param string $password
     * @return array
     */
    public function execute(string $phone_number, string $password): array;

}
