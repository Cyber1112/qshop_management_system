<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'working_schedule_type',
        'work_start',
        'work_end',
        'business_id'
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
