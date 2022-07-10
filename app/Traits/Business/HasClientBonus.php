<?php

namespace App\Traits\Business;


use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasClientBonus{

    public function clientBonus(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'business_client_bonuses', 'business_id', 'client_id');
    }

}
