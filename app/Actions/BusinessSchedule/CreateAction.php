<?php

namespace App\Actions\BusinessSchedule;

use App\Contracts\CreateBusinessSchedule;
use App\Dto\Business\BusinessSchedule\CreateDto;
use App\Helpers;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CreateAction implements CreateBusinessSchedule{

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {
        app(Tasks\BusinessSchedule\CreateTask::class)->run(
            $dto->toArray() + ["business_id" => $this->business_id]
        );
    }

}
