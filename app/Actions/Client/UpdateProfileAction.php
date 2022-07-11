<?php

namespace App\Actions\Client;

use App\Contracts\UpdateClientProfile;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Helpers;


class UpdateProfileAction implements UpdateClientProfile {

    protected $user_id;

    public function __construct(){
        $this->user_id = Auth::user()->id;
    }

    public function execute($data): void
    {
        $this->updataName($data->name);


        if ($data->image){
            $this->updateAvatar($data->image);
        }
    }


    public function updataName(string $name){
        app(Tasks\User\UpdateNameTask::class)->run(
            $this->user_id,
            $name
        );
    }

    public function updateAvatar($image){
        app(Tasks\User\UploadAvatarTask::class)->run(
            $this->user_id,
            $image
        );
    }

}
