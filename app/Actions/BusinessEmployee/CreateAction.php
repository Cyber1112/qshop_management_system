<?php

namespace App\Actions\BusinessEmployee;

use App\Contracts\CreateEmployee;
use App\Dto\Business\BusinessEmployee\CreateDto;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class CreateAction implements CreateEmployee{

    protected $business_id;

    public function __construct()
    {
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {
        $user = $this->createUser([
            "phone_number" => $dto->phone_number,
            "name" => $dto->name,
            "password" => $dto->password
        ]);

        $this->createEmployee([
            "position" => $dto->position,
            "business_id" => $this->business_id,
            "user_id" => $user->id
        ]);

        $this->assignRole($user, 'employee');
        $this->assignPermissionsToUser($user, $dto->permissions);
    }

    public function createUser(array $payload){
        return app(Tasks\User\CreateUserTask::class)->run($payload);
    }

    public function createEmployee(array $payload){
        app(Tasks\BusinessEmployee\CreateTask::class)->run($payload);
    }

    public function assignRole($user, $role){
        app(Tasks\User\AssignRoleTask::class)->run($user, $role);
    }

    public function assignPermissionsToUser($user, array $permissions){
        app(Tasks\User\GivePermissionsTask::class)->run(
            $user, $permissions
        );
    }

}
