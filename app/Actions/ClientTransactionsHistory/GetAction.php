<?php

namespace App\Actions\ClientTransactionsHistory;

use App\Contracts\GetClientTransactionsHistory;
use Illuminate\Support\Collection;
use App\Tasks;
use App\Helpers;
use Illuminate\Support\Facades\Auth;

class GetAction implements GetClientTransactionsHistory{

    protected $client_id;

    public function __construct(){
        $this->client_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $from, string $to): Collection
    {
        return $this->getData($from, $to)->groupBy('created_at');


    }

    public function getData(string $from, string $to){
        return app(Tasks\ClientTransactionsHistory\GetBetweenDateTask::class)->run(
            $this->client_id,
            $from,
            $to,
            ['transaction_histories.id', 'transaction_histories.bonus_percent', 'transaction_histories.cash',
                'transaction_histories.task', 'transaction_histories.created_at', 'businesses.business_name']
        )->map(function($row){
            return [
                'transaction_id' => $row['id'],
                'bonus_amount' => $row['task'] == 'accrual' ? (int) (($row['bonus_percent']*$row['cash'])/100) : null,
                'task' => $row['task'],
                'cash' => $row['cash'],
                'business_name' => $row['business_name'],
                'created_at' => date('Y-m-d', strtotime($row['created_at']))
            ];
        });
    }

}
