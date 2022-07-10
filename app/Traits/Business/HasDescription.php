<?php

namespace App\Traits\Business;

use App\Models\BusinessDescription;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasDescription{

    public function description(): HasOne
    {
        return $this->hasOne(BusinessDescription::class);
    }

}
