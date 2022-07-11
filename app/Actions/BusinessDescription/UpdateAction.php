<?php

namespace App\Actions\BusinessDescription;

use App\Contracts\UpdateBusinessDescription;
use App\Models\BusinessDescription;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UpdateAction implements UpdateBusinessDescription {



    public function execute(string $description, BusinessDescription $businessDescription): void
    {
        $this->ensureThatCanEditProfile();

        app(Tasks\BusinessDescription\UpdateTask::class)->run(
            $businessDescription->id,
            ['description' => $description]
        );
    }

    public function ensureThatCanEditProfile(){
        if(!Auth::user()->hasPermissionTo('edit profile')){
            throw new AccessDeniedHttpException("You do not have permission to edit profile");
        }
    }
}
