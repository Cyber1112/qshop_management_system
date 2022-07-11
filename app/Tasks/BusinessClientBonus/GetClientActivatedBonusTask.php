<?php

namespace App\Tasks\BusinessClientBonus;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class GetClientActivatedBonusTask{

    private BusinessClientBonusRepositoryInterface $bonusRepository;

    public function __construct(BusinessClientBonusRepositoryInterface $bonusRepository)
    {
        $this->bonusRepository = $bonusRepository;
    }

    public function run($client_id, array $columns = ['*']){
        return $this->bonusRepository->getClientActivatedBonus($client_id, $columns);
    }

}
