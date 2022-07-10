<?php

namespace App\Actions\TransactionsHistory;

use App\Contracts\GetClientAllDetailsPage;
use App\Models\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Tasks;

class GetClientAllDetailsPageAction implements GetClientAllDetailsPage {

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(Client $client, string $from, string $to): Collection
    {

        return $this->getData($client->id, $from, $to)->map(function($row){
            return [
                'transaction_id' => $row['id'],
                'name' => $row['name'],
                'phone_number' => $row['phone_number'],
                'bonus_percent' => $row['bonus_percent'],
                'cash' => $row['cash'],
                'task' => $row['task'],
                'create_at' => date('Y-m-d', strtotime($row['created_at']))
            ];
        });

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
}
