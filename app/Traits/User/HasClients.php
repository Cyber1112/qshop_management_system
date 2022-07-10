<?php

namespace App\Traits\User;

use App\Models\Client;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasClients{

    /**
     * @return HasOne
     */
    public function client(): HasOne
    {
        return $this->hasOne(Client::class);
    }

}
