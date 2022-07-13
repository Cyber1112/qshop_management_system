<?php

namespace App\Actions\BusinessBalance;

use App\Contracts\ApiGetCardBalanceHistory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class GetCardBalanceHistoryAction extends BalanceAction implements ApiGetCardBalanceHistory {


    public function execute(): Collection
    {
        $business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());

        return $this->payment_repository->getBusinessBalanceHistory(
            $business_id, ['amount', 'created_at']
        )->map(function ($row){
            return [
                'amount' => $row['amount'],
                'created_at' => date('Y-m-d', strtotime($row['created_at']))
            ];
        })->groupBy('created_at');
    }

}
