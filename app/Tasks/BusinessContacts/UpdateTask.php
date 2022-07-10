<?php

namespace App\Tasks\BusinessContacts;

use App\Repositories\BusinessContactRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UpdateTask{

    private BusinessContactRepositoryInterface $contactRepository;

    public function __construct(BusinessContactRepositoryInterface $contactRepository){
        $this->contactRepository = $contactRepository;
    }

    /**
     * @param int $id
     * @param array $payload
     * @return int
     */
    public function run(int $id, array $payload){
        return $this->contactRepository->update($id, $payload);
    }

}
