<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetBusinessTransactionsBetweenDate{

    private TransactionHistoryRepositoryInterface $historyRepository;

    public function __construct(TransactionHistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function run(int $business_id, string $from, string $to, array $columns = ['*']){
        return $this->historyRepository->getBusinessTransactionsBetweenDate(
            $business_id,
            $from,
            $to,
            $columns
        );
    }

}
