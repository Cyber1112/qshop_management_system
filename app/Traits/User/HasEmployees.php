<?php

namespace App\Traits\User;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasEmployees{

    public function employee(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }

}
