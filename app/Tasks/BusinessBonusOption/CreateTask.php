<?php

namespace App\Tasks\BusinessBonusOption;

use App\Repositories\BusinessBonusOptionRepositoryInterface;

class CreateTask{

    private BusinessBonusOptionRepositoryInterface $bonusOptionRepository;

    public function __construct(BusinessBonusOptionRepositoryInterface $bonusOptionRepository){
        $this->bonusOptionRepository = $bonusOptionRepository;
    }

    public function run(array $payload){
        return $this->bonusOptionRepository->create($payload);
    }

}
