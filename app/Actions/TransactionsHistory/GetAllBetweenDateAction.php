<?php

namespace App\Actions\TransactionsHistory;

use App\Contracts\GetAllTransactionsHistoryBetweenDate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Tasks;

class GetAllBetweenDateAction implements GetAllTransactionsHistoryBetweenDate{

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $from, string $to): Collection
    {
        $data = $this->getData($from, $to);

        return $data->map(function ($row){
            return [
                'transaction_id' => $row['id'],
                'bonus_percent' => $row['bonus_percent'],
                'cash' => $row['cash'],
                'task' => $row['task'],
                'name' => $row['name'],
                'phone_number' => $row['phone_number'],
                'created_at' => date('Y-m-d', strtotime($row['created_at']))
            ];
        })->sortBy('created_at');
    }

    public function getData(string $from, string $to){
        return app(Tasks\BusinessTransactionHistory\GetBusinessTransactionsBetweenDate::class)->run(
            $this->business_id,
            $from,
            $to,
            ['transaction_histories.id', 'transaction_histories.bonus_percent', 'transaction_histories.cash',
                'transaction_histories.task', 'transaction_histories.created_at',
                'users.name', 'users.phone_number']
        );
    }

}
