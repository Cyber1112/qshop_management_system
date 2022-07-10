<?php

namespace App\Tasks\User;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class FindByPhoneTask
{
    public UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $phone_number
     * @return User|null
     */
    public function run(string $phone_number): ?User
    {
        return $this->userRepository->findByPhone($phone_number);
    }
}
