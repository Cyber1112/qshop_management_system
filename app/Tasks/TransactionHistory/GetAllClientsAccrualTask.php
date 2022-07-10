<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class GetAllClientsAccrualTask{

    private TransactionHistoryRepositoryInterface $historyRepository;

    public function __construct(TransactionHistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function run(int $business_id, array $columns = ['*']){
        return $this->historyRepository->getBusinessClientsAccrual($business_id, $columns);
    }

}
