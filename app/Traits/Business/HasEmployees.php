<?php

namespace App\Traits\Business;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasEmployees{

    public function employee(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }

}
