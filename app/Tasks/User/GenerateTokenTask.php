<?php

namespace App\Tasks\User;

use App\Models\User;

class GenerateTokenTask{
    /**
     * @param User $user
     * @return string
     */
    public function run(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }
}


