<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\Employee\CreateRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Contracts;
use App\Dto;
use App\Http\Resources;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{

    public function getBusinessEmployees(Request $request)
    {
        return app(Contracts\GetBusinessEmployees::class)->execute();
    }

    public function create(CreateRequest $request): Response
    {
        app(Contracts\CreateEmployee::class)->execute(
            Dto\Business\BusinessEmployee\CreateDtoFactory::fromRequest($request)
        );

        return response()->noContent();
    }

    public function deleteEmployee(Request $request, Employee $employee): Response
    {
        $employee->delete();

        return response()->noContent();
    }

}
