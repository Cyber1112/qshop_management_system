<?php

namespace App\Tasks\BusinessAccount;

use App\Repositories\BusinessRepositoryInterface;

class UpdateBusinessNameTask{

    private BusinessRepositoryInterface $businessRepository;

    public function __construct(BusinessRepositoryInterface $businessRepository){
        $this->businessRepository = $businessRepository;
    }

    public function run(int $business_id, string $business_name){
        return $this->businessRepository->updateBusinessName($business_id, $business_name);
    }

}
