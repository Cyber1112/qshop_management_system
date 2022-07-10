<?php

namespace App\Tasks\BusinessDescription;

use App\Repositories\BusinessDescriptionRepositoryInterface;

class UpdateTask{

    private BusinessDescriptionRepositoryInterface $descriptionRepository;

    public function __construct(BusinessDescriptionRepositoryInterface $descriptionRepository){
        $this->descriptionRepository = $descriptionRepository;
    }

    /**
     * @param int $id
     * @param array $payload
     * @return int
     */
    public function run(int $id, array $payload){
        return $this->descriptionRepository->update($id, $payload);
    }

}
