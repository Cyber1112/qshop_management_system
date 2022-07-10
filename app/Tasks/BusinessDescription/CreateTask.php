<?php

namespace App\Tasks\BusinessDescription;

use App\Repositories\BusinessDescriptionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreateTask{

    private BusinessDescriptionRepositoryInterface $descriptionRepository;

    public function __construct(BusinessDescriptionRepositoryInterface $descriptionRepository){
        $this->descriptionRepository = $descriptionRepository;
    }

    /**
     * @param array $payload
     * @return Model
     */
    public function run(array $payload){
        return $this->descriptionRepository->create($payload);
    }

}
