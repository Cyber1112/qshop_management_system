<?php

namespace App\Http\Resources\User\Business\ClientTransactionDetail;

use App\Models\TransactionHistory;
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
        /** @var TransactionHistory $this */
        return [
            'client_name' => $this->client->user->name,
            'client_phone_number' => $this->client->user->phone_number,
            'business_name' => $this->business->user->name,
            'created_at' => $this->created_at,
            'cashback' => $this->task == 'accrual' ? (int) (($this->cash * $this->bonus_percent)/100) : null,
            'bonus_percent' => $this->task == 'accrual' ? $this->bonus_percent : null,
            'cash' => $this->cash
        ];
    }
}
