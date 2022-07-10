<?php

namespace App\Actions\BusinessEmployee;

use App\Contracts\GetBusinessEmployees;
use App\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class GetEmployeesAction implements GetBusinessEmployees {

    protected $business_id;

    public function __construct()
    {
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(): Collection
    {
        return app(Tasks\BusinessEmployee\GetBusinessEmployeesTask::class)->run(
            $this->business_id,
            ['employees.id as client_id', 'employees.position',
                'users.name', 'users.phone_number']
        );
    }



}
