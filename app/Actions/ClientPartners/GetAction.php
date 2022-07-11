<?php

namespace App\Actions\ClientPartners;

use App\Contracts\GetClientPartners;
use Illuminate\Support\Collection;
use App\Helpers;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class GetAction implements GetClientPartners{

    protected $client_id;

    public function __construct(){
        $this->client_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(): Collection
    {
        return app(Tasks\ClientPartners\GetTask::class)->run(
            $this->client_id,
            ['businesses.business_name', 'business_client_bonuses.balance', 'business_client_bonuses.activation_bonus_date',
                'businesses.id as business_id']
        )->filter(function($row){
            return $row['activation_bonus_date'] < now()->toDateTimeString();
        });
    }
}
