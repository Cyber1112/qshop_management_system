<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    protected $fillable = [
        'city',
    ];

    public function business(): HasOne
    {
        return $this->HasOne(User::class);
    }
}
