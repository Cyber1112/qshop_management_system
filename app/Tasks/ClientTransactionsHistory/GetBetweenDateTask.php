<?php

namespace App\Tasks\ClientTransactionsHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetBetweenDateTask{

    private TransactionHistoryRepositoryInterface $historyRepository;

    public function __construct(TransactionHistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function run(int $client_id, string $from, string $to, array $columns = ['*']){
        return $this->historyRepository->getClientTransactionsBetweenDate(
            $client_id,
            $from,
            $to,
            $columns
        );
    }

}
