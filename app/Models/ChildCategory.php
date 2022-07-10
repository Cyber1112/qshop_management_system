<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ChildCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_id'
    ];

    public function business(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'business_child_categories', 'category_id', 'business_id');
    }
}
