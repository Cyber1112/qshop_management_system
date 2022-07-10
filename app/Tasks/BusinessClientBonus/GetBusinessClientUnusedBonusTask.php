<?php

namespace App\Tasks\BusinessClientBonus;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class GetBusinessClientUnusedBonusTask{

    private BusinessClientBonusRepositoryInterface $bonus_repository;

    public function __construct(BusinessClientBonusRepositoryInterface $bonus_repository)
    {
        $this->bonus_repository = $bonus_repository;
    }

    public function run($client_id, $business_id){
        return $this->bonus_repository->getClientUnusedBonus($client_id, $business_id);
    }

}
