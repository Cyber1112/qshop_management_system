<?php

namespace App\Actions\Business;

use App\Contracts\UpdateBusinessProfile;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use App\Helpers;


class UpdateProfileAction implements UpdateBusinessProfile{

    protected $business_id;
    protected $user_id;

    public function __construct(){
        $this->user_id = Auth::user()->id;
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute($data): void
    {
        $this->updataName($data->name);

        $this->updateBusinessName($data->business_name);

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

    public function updateBusinessName(string $business_name){
        app(Tasks\BusinessAccount\UpdateBusinessNameTask::class)->run(
            $this->business_id,
            $business_name
        );
    }

    public function updateAvatar($image){
        app(Tasks\User\UploadAvatarTask::class)->run(
            $this->user_id,
            $image
        );
    }

}
