<?php

namespace App\Traits\Client;

use App\Models\Business;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasBusinessBonus{

    public function businessBonus(): BelongsToMany
    {
        return $this->belongsToMany(Business::class,'business_client_bonuses', 'client_id', 'business_id');
    }

}
