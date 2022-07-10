<?php

namespace App\Tasks\BusinessBonusOption;

use App\Repositories\BusinessBonusOptionRepositoryInterface;

class FindByBusinessIdTask{

    private BusinessBonusOptionRepositoryInterface $bonusOptionRepository;

    public function __construct(BusinessBonusOptionRepositoryInterface $bonusOptionRepository){
        $this->bonusOptionRepository = $bonusOptionRepository;
    }

    public function run(int $business_id){
        return $this->bonusOptionRepository->findByBusinessId($business_id);
    }

}
