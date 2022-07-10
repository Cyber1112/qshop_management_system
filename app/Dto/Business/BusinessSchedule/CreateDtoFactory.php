<?php

namespace App\Dto\Business\BusinessSchedule;



use App\Http\Requests\Business\Schedule\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'working_schedule_type' => $data['working_schedule_type'],
            'work_start' => $data['work_start'],
            'work_end' => $data['work_end']
        ]);
    }

}
