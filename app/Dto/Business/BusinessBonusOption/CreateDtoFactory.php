<?php

namespace App\Dto\Business\BusinessBonusOption;


use App\Http\Requests\Business\BonusOption\CreateRequest;

class CreateDtoFactory{

    public static function fromRequest(CreateRequest $request){
        return self::fromArray($request->validated());
    }

    public static function fromArray(array $data): CreateDto
    {
        return new CreateDto([
            'bonus_percent' => $data['bonus_percent'],
            'activation_bonus_period' => $data['activation_bonus_period'] ?? 0,
            'deactivation_bonus_period' => $data['deactivation_bonus_period'] ?? null
        ]);
    }

}
