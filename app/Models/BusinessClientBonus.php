<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessClientBonus extends Model
{
    use HasFactory;

    protected $fillable = [
        'balance',
        'business_id',
        'client_id',
        'activation_bonus_date',
        'deactivation_bonus_date'
    ];

}
