<?php

namespace App\Tasks\BusinessClientBonus;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class UpdateTask{

    private BusinessClientBonusRepositoryInterface $bonus_repository;

    public function __construct(BusinessClientBonusRepositoryInterface $bonus_repository)
    {
        $this->bonus_repository = $bonus_repository;
    }

    public function run(int $business_client_bonus_id, int $balance){
        return $this->bonus_repository->updateClientUnusedBonus($business_client_bonus_id, $balance);
    }

}
