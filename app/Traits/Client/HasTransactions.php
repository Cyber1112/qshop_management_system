<?php

namespace App\Traits\Client;

use App\Models\Business;
use App\Models\TransactionHistory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasTransactions{

    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'transaction_histories', 'client_id', 'business_id');
    }

}
