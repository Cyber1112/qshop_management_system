<?php

namespace App\Http\Resources\Category;

use App\Models\ChildCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ChildCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var ChildCategory $this */
        return [
            'id' => $this->id,
            'category_name' => $this->category_name
        ];
    }
}
