<?php

namespace App\Tasks\User;

use App\Models\User;

class AssignRoleTask{

    /**
     * @param User $user
     * @param $role
     * @return void
     */
    public function run(User $user, $role){
        $user->assignRole($role);
    }
}
