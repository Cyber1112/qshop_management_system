<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetBusinessAllTransactionsTask{

    private TransactionHistoryRepositoryInterface $historyRepository;

    public function __construct(TransactionHistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function run(int $business_id, array $columns = ['*']){
        return $this->historyRepository->getBusinessAllTransactions($business_id, $columns);
    }

}
