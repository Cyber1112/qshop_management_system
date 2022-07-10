<?php

namespace App\Traits\Business;

use App\Models\BusinessContacts;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasContact{

    public function contact(): HasOne
    {
        return $this->hasOne(BusinessContacts::class);
    }

}
