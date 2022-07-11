<?php

namespace App\Actions\ClientPartners;

use App\Contracts\GetClientUnactivatedBonus;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class GetUnactivatedBonusAction implements GetClientUnactivatedBonus{

    protected $client_id;

    public function __construct(){
        $this->client_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(): Collection
    {
        return app(Tasks\ClientPartners\GetTask::class)->run(
            $this->client_id,
            ['businesses.business_name', 'businesses.id', 'business_client_bonuses.balance', 'business_client_bonuses.activation_bonus_date']
        )->filter(function ($row){
            return $row['activation_bonus_date'] > now()->toDateTimeString();
        })->values();

    }
}
