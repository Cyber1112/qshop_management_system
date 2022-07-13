<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface PaymentRepositoryInterface extends EloquentRepositoryInterface{

    public function getBusinessBalanceHistory(
        int $business_id,
        array $columns = ['*']
    ): Collection;

}
