<?php

namespace App\Tasks\BusinessClientBonus;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class CreateTask{

    private BusinessClientBonusRepositoryInterface $bonusRepository;

    public function __construct(BusinessClientBonusRepositoryInterface $bonusRepository)
    {
        $this->bonusRepository = $bonusRepository;
    }

    public function run(array $payload){
        return $this->bonusRepository->create($payload);
    }

}
