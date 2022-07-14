<?php

namespace App\Http\Resources\User\Business\Account;

use Illuminate\Http\Resources\Json\JsonResource;

class BalanceResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'balance' => $this->balance
        ];
    }
}
