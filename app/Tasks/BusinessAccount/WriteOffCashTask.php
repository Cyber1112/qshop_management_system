<?php

namespace App\Tasks\BusinessAccount;

use App\Repositories\BusinessRepositoryInterface;

class WriteOffCashTask{

    private BusinessRepositoryInterface $businessRepository;

    public function __construct(BusinessRepositoryInterface $businessRepository){
        $this->businessRepository = $businessRepository;
    }

    public function run(int $business_id, int $cash){
        return $this->businessRepository->writeOffCash($business_id, $cash);
    }

}
