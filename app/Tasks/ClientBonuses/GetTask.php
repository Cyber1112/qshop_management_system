<?php

namespace App\Tasks\ClientBonuses;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class GetTask{

    private BusinessClientBonusRepositoryInterface $clientBonusRepository;

    public function __construct(BusinessClientBonusRepositoryInterface $clientBonusRepository){
        $this->clientBonusRepository = $clientBonusRepository;
    }

    public function run(int $client_id, array $columns = ['*']){
        return $this->clientBonusRepository->getClientBonuses($client_id, $columns);
    }

}
