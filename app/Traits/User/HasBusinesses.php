<?php

namespace App\Traits\User;

use App\Models\Business;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasBusinesses{

    /**
     * @return HasOne
     */
    public function business(): HasOne
    {
        return $this->hasOne(Business::class);
    }

}
