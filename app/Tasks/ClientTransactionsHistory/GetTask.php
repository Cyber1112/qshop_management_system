<?php

namespace App\Tasks\ClientTransactionsHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetTask{

    private TransactionHistoryRepositoryInterface $historyRepository;

    public function __construct(TransactionHistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function run(int $client_id, array $columns = ['*']){
        return $this->historyRepository->getClientTransactions(
            $client_id,
            $columns
        );
    }

}
