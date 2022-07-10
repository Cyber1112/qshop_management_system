<?php

namespace App\Dto\Business\BusinessEmployee;

use App\Http\Requests\Business\Employee\CreateRequest;
use Illuminate\Support\Facades\Hash;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'phone_number' => $data['phone_number'],
            'name' => $data['name'],
            'position' => $data['position'],
            'password' => Hash::make($data['password']),
            'permissions' => $data['permissions']
        ]);
    }

}
