<?php

namespace App\Tasks\User;

use App\Models\User;

class UpdateNameTask{

    /**
     * @param int $user_id
     * @param string $name
     * @return void
     */
    public function run(int $user_id, string $name): void
    {
        User::where('id', $user_id)->update(['name' => $name]);
    }

}
