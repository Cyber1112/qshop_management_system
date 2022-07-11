<?php

namespace App\Actions\Business;

use App\Contracts\DeleteAvatar;
use Illuminate\Support\Facades\Auth;
use App\Tasks;


class DeleteAvatarAction implements DeleteAvatar {

    protected $user_id;

    public function __construct(){
        $this->user_id = Auth::user()->id;
    }

    public function execute(): void
    {
        app(Tasks\User\DeleteAvatarTask::class)->run($this->user_id);
    }




}
