<?php

namespace App\Tasks\BusinessClientBonus;

use App\Repositories\BusinessClientBonusRepositoryInterface;

class DeleteClientBonusTask{

    private BusinessClientBonusRepositoryInterface $bonus_repository;

    public function __construct(BusinessClientBonusRepositoryInterface $bonus_repository)
    {
        $this->bonus_repository = $bonus_repository;
    }

    public function run(int $id){
        return $this->bonus_repository->deleteClientBonus($id);
    }

}
