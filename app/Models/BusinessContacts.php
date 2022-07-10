<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessContacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone_number',
        'site_location',
        'business_id'
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
