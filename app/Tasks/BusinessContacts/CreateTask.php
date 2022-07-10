<?php

namespace App\Tasks\BusinessContacts;

use App\Repositories\BusinessContactRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreateTask{

    private BusinessContactRepositoryInterface $contactRepository;

    public function __construct(BusinessContactRepositoryInterface $contactRepository){
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param array $payload
     * @return Model
     */
    public function run(array $payload){
        return $this->contactRepository->create($payload);
    }

}
