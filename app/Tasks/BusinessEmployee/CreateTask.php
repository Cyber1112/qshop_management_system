<?php

namespace App\Tasks\BusinessEmployee;

use App\Repositories\EmployeeRepositoryInterface;

class CreateTask{

    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function run(array $payload){
        return $this->employeeRepository->create($payload);
    }
}
