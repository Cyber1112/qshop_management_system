<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionHistory;
use App\Repositories\TransactionHistoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TransactionHistoryRepository extends BaseRepository implements TransactionHistoryRepositoryInterface{

    public function __construct(TransactionHistory $model){
        $this->model = $model;
    }

    public function getBusinessTransactionsBetweenDate(int $business_id, string $from, string $to, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->whereBetween('transaction_histories.created_at', [$from, $to])
            ->join('clients', 'clients.id', '=', 'transaction_histories.client_id')
            ->join('users', 'users.id', '=', 'clients.user_id')
            ->get();

    }


    public function getBusinessClientsAccrual(int $business_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->where('task', '=','accrual')
            ->join('clients', 'clients.id', '=', 'transaction_histories.client_id')
            ->join('users', 'users.id', '=', 'clients.user_id')
            ->get();
    }

    public function getClientDetailsInformation(int $business_id, int $client_id, string $from, string $to, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->where('client_id', $client_id)
            ->whereBetween('transaction_histories.created_at', [$from, $to])
            ->join('clients', 'clients.id', '=', 'transaction_histories.client_id')
            ->join('users', 'users.id', '=', 'clients.user_id')
            ->get();
    }

    public function getBusinessAllTransactions(int $business_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->where('task', '=','accrual')
            ->get();
    }
}
