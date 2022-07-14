<?php

namespace App\Actions\BusinessSchedule;

use App\Contracts\UpdateBusinessSchedule;
use App\Dto\Business\BusinessSchedule\CreateDto;
use App\Models\BusinessSchedule;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UpdateAction implements UpdateBusinessSchedule {

    public function execute(CreateDto $dto, BusinessSchedule $schedule): void
    {
        app(Tasks\BusinessSchedule\UpdateTask::class)->run(
            $schedule->id,
            $dto->toArray()
        );
    }

}
