<?php

namespace App\Actions\BusinessBonusOption;

use App\Contracts\CreateBusinessBonusOption;
use App\Dto\Business\BusinessBonusOption\CreateDto;
use App\Helpers;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CreateAction implements CreateBusinessBonusOption{

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {
        $this->ensureThatCanEditProfile();

        $this->delete();

        app(Tasks\BusinessBonusOption\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $this->business_id]
        );
    }

    public function ensureThatCanEditProfile(){
        if(!Auth::user()->hasPermissionTo('edit profile')){
            throw new AccessDeniedHttpException("You do not have permission to edit profile");
        }
    }

    public function delete(){
        app(Tasks\BusinessBonusOption\DeleteTask::class)->run($this->business_id);
    }
}
