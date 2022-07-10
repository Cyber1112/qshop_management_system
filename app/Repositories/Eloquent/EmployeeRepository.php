<?php

namespace App\Repositories\Eloquent;


use App\Models\Employee;
use App\Repositories\EmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface{

    public function __construct(Employee $model){
        $this->model = $model;
    }

    public function findByUserId(
        int $user_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): ?Employee
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('user_id', $user_id)
            ->with($relations)
            ->withCount($relations_count)
            ->first();
    }

    public function deleteEmployee($employee_id): ?bool
    {
        return $this->model
                ->query()
                ->where('id', $employee_id)
                ->delete();
    }

    public function getBusinessEmployees(int $business_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->get();
    }
}
