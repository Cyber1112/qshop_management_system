<?php

namespace App\Contracts;

interface Logout
{
    /**
     * @return void
     */
    public function execute(): void;
}
