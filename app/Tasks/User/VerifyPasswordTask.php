<?php

namespace App\Tasks\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VerifyPasswordTask{

    /**
     * @param User $user
     * @param $password
     * @return bool
     */
    public function run(User $user, $password): bool
    {
        if (!Hash::check($password, $user->password)) {
            return false;
        }
        return true;
    }
}
