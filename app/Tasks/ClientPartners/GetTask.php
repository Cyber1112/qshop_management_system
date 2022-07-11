<?php

namespace App\Tasks\ClientPartners;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class GetTask{

    private BusinessClientBonusRepositoryInterface $clientBonusRepository;

    public function __construct(BusinessClientBonusRepositoryInterface $clientBonusRepository){
        $this->clientBonusRepository = $clientBonusRepository;
    }

    public function run(int $client_id, array $columns = ['*']){
        return $this->clientBonusRepository->getClientPartners($client_id, $columns);
    }

}
