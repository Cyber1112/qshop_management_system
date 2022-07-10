<?php

namespace App\Actions\TransactionsHistory;

use App\Contracts\GetClientDetailedPage;
use App\Models\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Tasks;

class GetClientDetailedPageAction implements GetClientDetailedPage {

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(Client $client, string $from, string $to): Collection
    {
        $total_bonus = $this->getClientTotalBonus($client->id);

        $data = $this->getData($client->id, $from, $to);
        $number_of_transactions = 0;
        $sum_total_transactions = 0;
        $accrued = 0;
        $withdrawn = 0;

        foreach ($data as $item){
            if ($item['task'] == 'accrual'){
                $number_of_transactions += 1;
                $sum_total_transactions += $item['cash'];
                $accrued += (int)(($item['bonus_percent']*$item['cash'])/100);
            }else{
                $withdrawn += $item['cash'];
            }
        }

        return collect([
            'name' => $data[0]['name'],
            'phone_number' => $data[0]['phone_number'],
            'total_bonus' => $total_bonus,
            'number_of_transactions' => $number_of_transactions,
            'sum_total_transactions' => $sum_total_transactions,
            'accrued' => $accrued,
            'withdrawn' => $withdrawn
        ]);
    }

    public function getData(int $client_id, string $from, string $to){
        return app(Tasks\TransactionHistory\GetClientDetailedPageTask::class)->run(
            $this->business_id,
            $client_id,
            $from,
            $to,
            ['transaction_histories.id', 'transaction_histories.bonus_percent', 'transaction_histories.cash',
                'transaction_histories.task', 'transaction_histories.created_at', 'users.name', 'users.phone_number']
        );
    }

    public function getClientTotalBonus($client_id){
        return app(Tasks\BusinessClientBonus\GetClientOnBusinessTotalBalanceTask::class)->run(
            $this->business_id,
            $client_id
        );
    }
}
