<?php

namespace App\Tasks\BusinessEmployee;

use App\Repositories\EmployeeRepositoryInterface;

class GetBusinessEmployeesTask{

    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function run(int $business_id, array $columns = ['*']){
        return $this->employeeRepository->getBusinessEmployees($business_id, $columns);
    }
}
