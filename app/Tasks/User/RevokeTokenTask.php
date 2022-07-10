<?php

namespace App\Tasks\User;

use App\Models\User;

class RevokeTokenTask{

    /**
     * @param User $user
     * @return void
     */
    public function run(User $user): void
    {
        $user->tokens()->delete();
    }

}
