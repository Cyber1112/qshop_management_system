<?php

namespace App\Dto\Business\BusinessPayment;


use App\Http\Requests\Business\BusinessPayment\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'phone_number' => $data['phone_number'],
            'bonus_percent' => $data['bonus_percent'],
            'cash' => $data['cash'],
            'task' => $data['task'],
            'comment' => $data['comment'] ?? null
        ]);
    }

}
