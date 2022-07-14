<?php

namespace App\Http\Resources\User\Business\About;

use App\Models\Business;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
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
        /** @var Business $this */
        return [
            'contacts' => [
                'address' => $this->contact->address,
                'phone_number' => $this->contact->phone_number,
                'site_location' => $this->contact->site_location
            ],
            'city' => $this->user->city->city,
            'description' => $this->description->description,
            'categories' => $this->childCategories->pluck('category_name')->toArray(),
            'schedule' => [
                'working_schedule_type' => $this->schedule->working_schedule_type,
                'work_start' => $this->schedule->work_start,
                'work_end' => $this->schedule->work_end,
            ]
        ];
    }
}
