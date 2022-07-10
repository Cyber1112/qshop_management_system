<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'business_id'
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
