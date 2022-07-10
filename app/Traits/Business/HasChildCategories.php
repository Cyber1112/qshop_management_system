<?php

namespace App\Traits\Business;

use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasChildCategories{

    public function childCategories(): BelongsToMany
    {
        return $this->belongsToMany(ChildCategory::class, 'business_child_categories', 'business_id', 'category_id');
    }

}
