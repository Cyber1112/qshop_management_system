<?php

namespace App\Http\Resources\User\Client;

use App\Models\Client;
use Illuminate\Http\Resources\Json\JsonResource;

class MainPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var Client $this */
        return [
            'saved_money' => $this->whenPivotLoaded('transaction_histories', function(){
                return $this->pivot->cash;
            })
        ];
    }
}
