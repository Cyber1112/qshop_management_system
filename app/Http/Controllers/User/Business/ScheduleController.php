<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\Schedule\CreateRequest;
use App\Models\BusinessSchedule;
use Illuminate\Http\Request;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    public function show(Request $request, BusinessSchedule $schedule){
        return response()->json([
            'id' => $schedule->id,
            'working_schedule_type' => $schedule->working_schedule_type,
            'work_start' => $schedule->work_start,
            'work_end' => $schedule->work_end
        ]);
    }

    public function create(CreateRequest $request): Response
    {
        app(Contracts\CreateBusinessSchedule::class)->execute(
            Dto\Business\BusinessSchedule\CreateDtoFactory::fromRequest($request)
        );

        return response()->noContent();
    }

    public function update(CreateRequest $request, BusinessSchedule $schedule){
        app(Contracts\UpdateBusinessSchedule::class)->execute(
            Dto\Business\BusinessSchedule\CreateDtoFactory::fromRequest($request),
            $schedule
        );
    }
}
