<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Resources\Json\JsonResource;

class CardAddResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'redirect_url' => $this['redirect_url'],
            'request_url' => $this['request_url'],
        ];
    }
}
