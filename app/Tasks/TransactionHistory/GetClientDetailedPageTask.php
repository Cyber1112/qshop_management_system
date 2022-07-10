<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetClientDetailedPageTask{

    private TransactionHistoryRepositoryInterface $historyRepository;

    public function __construct(TransactionHistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function run(int $business_id, int $client_id, string $from, string $to, array $columns = ['*']){
        return $this->historyRepository->getClientDetailsInformation(
            $business_id,
            $client_id,
            $from,
            $to,
            $columns
        );
    }

}
