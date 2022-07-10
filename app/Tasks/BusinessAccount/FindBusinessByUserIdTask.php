<?php

namespace App\Tasks\BusinessAccount;

use App\Repositories\BusinessRepositoryInterface;

class FindBusinessByUserIdTask{

    private BusinessRepositoryInterface $businessRepository;

    public function __construct(BusinessRepositoryInterface $businessRepository){
        $this->businessRepository = $businessRepository;
    }

    public function run(int $user_id){
        return $this->businessRepository->getBusinessByUserId($user_id);
    }

}
