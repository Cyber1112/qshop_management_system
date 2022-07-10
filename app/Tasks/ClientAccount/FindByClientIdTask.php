<?php

namespace App\Tasks\ClientAccount;

use App\Repositories\ClientRepositoryInterface;

class FindByClientIdTask{

    private ClientRepositoryInterface $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository){
        $this->clientRepository = $clientRepository;
    }

    public function run(int $user_id){
        return $this->clientRepository->findByUserId($user_id);
    }

}
