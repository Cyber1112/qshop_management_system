<?php

namespace App\Actions\BusinessDescription;

use App\Contracts\CreateBusinessDescription;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CreateAction implements CreateBusinessDescription{

    protected $business;

    public function __construct(){
        $this->business = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $description): void
    {
        $this->ensureThatCanEditProfile();

        app(Tasks\BusinessDescription\CreateTask::class)->run(
            [
                'description' => $description,
                'business_id' => $this->business
            ]
        );
    }

    public function ensureThatCanEditProfile(){
        if(!Auth::user()->hasPermissionTo('edit profile')){
            throw new AccessDeniedHttpException("You do not have permission to edit profile");
        }
    }

}
