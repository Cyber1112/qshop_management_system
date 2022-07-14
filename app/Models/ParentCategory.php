<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_name',
    ];

    public function parentChildCategories(){
        return $this->hasMany(ChildCategory::class, 'category_id');
    }

}
