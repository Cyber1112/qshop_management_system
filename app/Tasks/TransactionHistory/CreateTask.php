<?php

namespace App\Tasks\TransactionHistory;

use App\Repositories\TransactionHistoryRepositoryInterface;

class CreateTask{

    private TransactionHistoryRepositoryInterface $historyRepository;

    public function __construct(TransactionHistoryRepositoryInterface $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function run(array $payload){
        return $this->historyRepository->create($payload);
    }

}
