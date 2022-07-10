<?php

namespace App\Traits\Business;

use App\Models\BusinessBonusOption;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasBonus{

    public function bonus(): HasOne
    {
        return $this->HasOne(BusinessBonusOption::class);
    }

}
