<?php

namespace App\Models;

use App\Traits\Client\HasBusinessBonus;
use App\Traits\Client\HasTransactions;
use App\Traits\Client\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Client
 *
 * @method static Builder|Client query()
 */
class Client extends Model
{
    use HasFactory, HasUser, HasTransactions, HasBusinessBonus;

    protected $fillable = [
        'user_id'
    ];
}
