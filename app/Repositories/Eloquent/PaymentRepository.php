<?php

namespace App\Repositories\Eloquent;

use App\Models\Payment;
use App\Repositories\PaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface{

    public function __construct(Payment $model){
        $this->model = $model;
    }

    public function getBusinessBalanceHistory(int $business_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->where('status_id', '=', 'paid')
            ->get();
    }
}
