<?php

namespace App\Actions\Client;

use App\Contracts\GetClientMainPage;
use Illuminate\Support\Collection;
use App\Helpers;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class GetAction implements GetClientMainPage{

    protected $client_id;

    public function __construct(){
        $this->client_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(): Collection
    {
        $transactions = $this->getTransactions();

        $clientBonuses = $this->getClientBonuses();

        return collect([
            'number_of_transactions' => $this->getNumberOfTransactions($transactions),
            'number_of_partners' => $this->getNumberOfPartners($transactions),
            'saved_money' => $this->getSavedMoney($transactions),
            'total_bonus' => $this->getTotalBonus($clientBonuses),
            'number_of_unactivated_bonus' => $this->getTotalUnactivatedBonus($clientBonuses)
        ]);
    }

    public function getClientBonuses(){
        return app(Tasks\ClientBonuses\GetTask::class)->run(
            $this->client_id,
            ['balance', 'activation_bonus_date']
        );
    }

    public function getTransactions(){
        return app(Tasks\ClientTransactionsHistory\GetTask::class)->run(
            $this->client_id,
            ['cash', 'task', 'business_id']
        );
    }

    public function getTotalBonus($clientBonuses){
        return $clientBonuses->filter(function ($row) {
            return $row['activation_bonus_date'] < now()->toDateTimeString();
        })->sum('balance');
    }

    public function getNumberOfTransactions($transactions){
        return $transactions->count();
    }

    public function getNumberOfPartners($transactions){
        return $transactions->groupBy('business_id')->count();
    }

    public function getSavedMoney($transactions){
        return $transactions->where('task', '=', 'withdrawal')->sum('cash');
    }

    public function getTotalUnactivatedBonus($clientBonuses){
        return $clientBonuses->filter(function ($row) {
            return $row['activation_bonus_date'] > now()->toDateTimeString();
        })->count();
    }


}
