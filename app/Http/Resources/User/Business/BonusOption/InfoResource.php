<?php

namespace App\Http\Resources\User\Business\BonusOption;

use App\Models\BusinessBonusOption;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var BusinessBonusOption $this */
        return [
            'bonus_percent' => $this->bonus_percent,
            'activation_bonus_period' => $this->activation_bonus_period,
            'deactivation_bonus_period' => $this->activation_bonus_period
        ];
    }
}
