<?php

namespace App\Actions\BusinessContacts;

use App\Contracts\UpdateBusinessContacts;
use App\Dto\Business\BusinessContacts\CreateDto;
use App\Helpers;
use App\Models\BusinessContacts;
use App\Tasks;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class UpdateAction implements UpdateBusinessContacts {

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto, BusinessContacts $contacts): void
    {
        app(Tasks\BusinessContacts\UpdateTask::class)->run(
            $contacts->id,
            $dto->toArray()
        );
    }

}
