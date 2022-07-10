<?php

namespace App\Actions\BusinessClients;

use App\Contracts\GetBusinessClients;
use Illuminate\Support\Collection;
use App\Helpers;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class GetAction implements GetBusinessClients{

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(): Collection
    {
        $data = $this->getData();

        return $this->getDataWithCalculatedBonus($data);
    }

    public function getData(){
        return app(Tasks\TransactionHistory\GetAllClientsAccrualTask::class)->run(
            $this->business_id,
            ['transaction_histories.bonus_percent', 'transaction_histories.cash',
                'users.name', 'users.phone_number', 'clients.id as client_id']
        );
    }

    public function getDataWithCalculatedBonus($data){
        return $data->map(function($row){
           return [
               'client_id' => $row['client_id'],
               'name' => $row['name'],
               'phone_number' => $row['phone_number'],
               'bonus' => (int)(($row['bonus_percent'] * $row['cash'])/100)
           ];
        })->groupBy('client_id')->map(function($row){
            $firstRow = $row->first();
            return [
                'client_id' => $firstRow['client_id'],
                'name' => $firstRow['name'],
                'phone_number' => $firstRow['phone_number'],
                'bonus' => $row->sum('bonus'),
                'number_of_purchases' => $row->count()
            ];
        })->values();
    }

}
