<?php

namespace App\Models;

use App\Traits\Business\HasBonus;
use App\Traits\Business\HasChildCategories;
use App\Traits\Business\HasClientBonus;
use App\Traits\Business\HasContact;
use App\Traits\Business\HasDescription;
use App\Traits\Business\HasEmployees;
use App\Traits\Business\HasSchedule;
use App\Traits\Business\HasTransactions;
use App\Traits\Business\HasUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Business
 *
 * @method static Builder|Business query()
 */
class Business extends Model
{
    use HasFactory, HasDescription, HasContact,
        HasSchedule, HasChildCategories, HasEmployees,
        HasBonus, HasTransactions, HasClientBonus, HasUser;

    protected $fillable = [
        'business_name',
        'balance',
        'user_id'
    ];


}
