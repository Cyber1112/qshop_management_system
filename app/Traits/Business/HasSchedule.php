<?php

namespace App\Traits\Business;

use App\Models\BusinessSchedule;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasSchedule{

    public function schedule(): HasOne
    {
        return $this->hasOne(BusinessSchedule::class);
    }

}
