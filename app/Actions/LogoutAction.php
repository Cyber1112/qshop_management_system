<?php

namespace App\Actions;

use App\Contracts\Logout;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class LogoutAction implements Logout
{
    /**
     * @return void
     */
    public function execute(): void
    {
        $user = Auth::user();

        app(Tasks\User\RevokeTokenTask::class)->run($user);
    }
}
