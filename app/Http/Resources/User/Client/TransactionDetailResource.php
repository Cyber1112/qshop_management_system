<?php

namespace App\Http\Resources\User\Client;

use App\Models\TransactionHistory;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionDetailResource extends JsonResource
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
            'bonus_amount' => $this->task == 'accrual' ? (int)(($this->bonus_percent * $this->cash) / 100) : null,
            'cash' => $this->cash,
            'bonus_percent' => $this->bonus_percent,
            'created_at' => $this->created_at,
            'partner' => $this->business->business_name,
            'partner_id' => $this->business->id
        ];
    }
}
