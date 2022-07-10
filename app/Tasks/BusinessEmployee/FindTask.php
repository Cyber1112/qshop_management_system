<?php

namespace App\Tasks\BusinessEmployee;

use App\Repositories\EmployeeRepositoryInterface;

class FindTask{

    private EmployeeRepositoryInterface $employee_repository;

    public function __construct(EmployeeRepositoryInterface $employee_repository){
        $this->employee_repository = $employee_repository;
    }

    public function run(int $user_id){
        return $this->employee_repository->findByUserId($user_id);
    }

}
