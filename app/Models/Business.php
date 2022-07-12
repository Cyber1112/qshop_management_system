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
use Illuminate\Support\Facades\Auth;
use App\Helpers;

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

    const NAMESPACE = 'App\Models\Business';

    protected $fillable = [
        'business_name',
        'balance',
        'user_id'
    ];

    public function getClientBonus(){
        $client = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
        return $this->clientBonus()->where('client_id', $client)
            ->where('activation_bonus_date', '<', now()->toDateTimeString())
            ->sum('business_client_bonuses.balance');
    }


}
