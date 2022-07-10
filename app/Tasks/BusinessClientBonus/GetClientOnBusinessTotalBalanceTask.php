<?php

namespace App\Tasks\BusinessClientBonus;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class GetClientOnBusinessTotalBalanceTask{

    private BusinessClientBonusRepositoryInterface $bonus_repository;

    public function __construct(BusinessClientBonusRepositoryInterface $bonus_repository)
    {
        $this->bonus_repository = $bonus_repository;
    }

    public function run(int $business_id, int $client_id){
        return $this->bonus_repository->getClientOnBusinessTotalBonus($business_id, $client_id);
    }

}
