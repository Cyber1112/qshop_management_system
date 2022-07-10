<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepositoryInterface extends EloquentRepositoryInterface{

    /**
     * @param int $user_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Employee|null
     */
    public function findByUserId(
        int $user_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): ?Employee;


    public function deleteEmployee($employee_id): ?bool;

    public function getBusinessEmployees(
        int $business_id,
        array $columns = ['*']
    ): Collection;

}
