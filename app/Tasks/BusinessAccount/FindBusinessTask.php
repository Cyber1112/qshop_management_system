<?php

namespace App\Tasks\BusinessAccount;

use App\Repositories\BusinessRepositoryInterface;

class FindBusinessTask{

    private BusinessRepositoryInterface $businessRepository;

    public function __construct(BusinessRepositoryInterface $businessRepository){
        $this->businessRepository = $businessRepository;
    }

    public function run(int $business_id){
        return $this->businessRepository->find($business_id);
    }

}
