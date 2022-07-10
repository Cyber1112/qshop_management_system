<?php

namespace App\Traits\User;

use App\Models\City;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCity{

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

}
