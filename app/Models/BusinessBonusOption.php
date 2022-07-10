<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\BusinessBonusOption
 *
 * @method static Builder|BusinessBonusOption query()
 */
class BusinessBonusOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_percent',
        'activation_bonus_period',
        'deactivation_bonus_period',
        'business_id'
    ];

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
