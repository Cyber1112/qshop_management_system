<?php

namespace App\Tasks\User;

use App\Models\User;

class GivePermissionsTask{

    /**
     * @param User $user
     * @param array $permissions
     * @return void
     */
    public function run(User $user, array $permissions): void
    {

        foreach ($permissions as $permission){
            $user->givePermissionTo($permission);
        }

    }

}
