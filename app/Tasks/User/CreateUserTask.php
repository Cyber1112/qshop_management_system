<?php

namespace App\Tasks\User;

use App\Repositories\UserRepositoryInterface;

class CreateUserTask{

    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function run(array $payload){
        return $this->userRepository->create($payload);
    }

}
