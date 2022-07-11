<?php

namespace App\Actions\TransactionsHistory;

use App\Contracts\GetTransactionsHistoryBetweenDate;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Tasks;

class GetBetweenDateAction implements GetTransactionsHistoryBetweenDate{

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(string $from, string $to): Collection
    {
        $data = $this->getData($from, $to);

        $numberOfTransactions = $this->getCountTransactions($data);
        $totalSum = $this->getTotalSumTransactions($data);

        return collect([
            "total_transactions" => $numberOfTransactions,
            "total_sum" => $totalSum,
            "average" => (int) ($totalSum/$numberOfTransactions),
            "accrued_bonus" => $this->getAccruedBonus($data),
            "written_off_bonus" => $this->getWrittenOffBonus($data)
        ]);
    }

    public function getData(string $from, string $to){
        return app(Tasks\BusinessTransactionHistory\GetBusinessTransactionsBetweenDate::class)->run(
            $this->business_id,
            $from,
            $to,
            ['transaction_histories.id', 'transaction_histories.bonus_percent', 'transaction_histories.cash',
                'transaction_histories.task']
        );
    }

    public function getCountTransactions($data){
        return $data->where('task', 'accrual')->count();
    }

    public function getTotalSumTransactions($data){
        return $data->where('task', 'accrual')->sum('cash');
    }

    public function getAccruedBonus($data){
        $accrued_bonus = 0;
        $data->map(function ($row) use (&$accrued_bonus){
            if ($row['task'] == "accrual"){
                $accrued_bonus += (int) (($row['cash'] * $row['bonus_percent'])/100);
            }
        });
        return $accrued_bonus;
    }

    public function getWrittenOffBonus($data){
        return $data->where('task', 'withdrawal')->sum('cash');
    }

}
