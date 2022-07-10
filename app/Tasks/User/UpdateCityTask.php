<?php

namespace App\Tasks\User;

use App\Repositories\UserRepositoryInterface;

class UpdateCityTask{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function run(int $id, array $payload){
        $this->userRepository->update($id, $payload);
    }

}
