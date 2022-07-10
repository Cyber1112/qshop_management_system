<?php

namespace App\Traits\Business;

use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasTransactions{

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'transaction_histories', 'business_id', 'client_id');
    }

}
