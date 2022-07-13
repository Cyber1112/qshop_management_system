<?php

namespace App\Actions\BusinessBalance;

use App\Contracts\ApiGetCardBalanceHistory;
use App\Repositories\BusinessRepositoryInterface;
use App\Repositories\PaymentRepositoryInterface;
use App\Services\Payments\TarlanPaymentService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class GetCardBalanceHistoryAction extends BalanceAction implements ApiGetCardBalanceHistory {

    protected $business_id;

    public function __construct(BusinessRepositoryInterface $businessBalanceRepository, PaymentRepositoryInterface $paymentRepository, TarlanPaymentService $tarlan_payment_service)
    {
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
        parent::__construct($businessBalanceRepository, $paymentRepository, $tarlan_payment_service);
    }

    public function execute(): Collection
    {
        return $this->payment_repository->getBusinessBalanceHistory(
            $this->business_id, ['amount', 'created_at']
        )->map(function ($row){
            return [
                'amount' => $row['amount'],
                'created_at' => date('Y-m-d', strtotime($row['created_at']))
            ];
        })->groupBy('created_at');
    }

}
