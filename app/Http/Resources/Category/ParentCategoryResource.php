<?php

namespace App\Http\Resources\Category;

use App\Models\ParentCategory;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /** @var ParentCategory $this */
        return [
            'category_id' => $this->id,
            'category_name' => $this->category_name,
            'child-categories' => $this->parentChildCategories->map(function ($row){
                return [
                    'id' => $row['id'],
                    'category_name' => $row['category_name'],
                    'category_id' => $row['category_id']
                ];
            })
        ];
    }
}
