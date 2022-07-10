<?php

namespace App\Tasks\BusinessBonusOption;

use App\Repositories\BusinessBonusOptionRepositoryInterface;

class DeleteTask{

    private BusinessBonusOptionRepositoryInterface $bonusOptionRepository;

    public function __construct(BusinessBonusOptionRepositoryInterface $bonusOptionRepository){
        $this->bonusOptionRepository = $bonusOptionRepository;
    }

    public function run(int $business_id){
        return $this->bonusOptionRepository->delete($business_id);
    }

}
