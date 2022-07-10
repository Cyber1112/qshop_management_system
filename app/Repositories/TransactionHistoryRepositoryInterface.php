<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface TransactionHistoryRepositoryInterface extends EloquentRepositoryInterface{


    public function getBusinessTransactionsBetweenDate(
        int $business_id,
        string $from,
        string $to,
        array $columns = ['*']
    ): Collection;


    public function getBusinessClientsAccrual(
        int $business_id,
        array $columns = ['*']
    ): Collection;

    public function getClientDetailsInformation(
        int $business_id,
        int $client_id,
        string $from,
        string $to,
        array $columns = ['*']
    ): Collection;

    public function getBusinessAllTransactions(
        int $business_id,
        array $columns = ['*']
    ): Collection;

}
