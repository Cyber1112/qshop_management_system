<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessChildCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'category_id',
    ];

    public $timestamps = false;
}
