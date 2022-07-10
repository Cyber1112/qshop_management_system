<?php

namespace App\Dto\Business\BusinessWithdrawal;

use App\Http\Requests\Business\BusinessWithdrawal\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'phone_number' => $data['phone_number'],
            'cash' => $data['cash'],
            'task' => $data['task'],
            'comment' => $data['comment'] ?? null
        ]);
    }

}
