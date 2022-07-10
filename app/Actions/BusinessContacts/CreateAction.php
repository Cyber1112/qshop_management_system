<?php

namespace App\Actions\BusinessContacts;

use App\Contracts\CreateBusinessContacts;
use App\Dto\Business\BusinessContacts\CreateDto;
use App\Helpers;
use App\Tasks;
use Illuminate\Support\Facades\Auth;

class CreateAction implements CreateBusinessContacts {

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {
        app(Tasks\BusinessContacts\CreateTask::class)->run(
            $dto->toArray() + ['business_id' => $this->business_id]
        );
    }
}
