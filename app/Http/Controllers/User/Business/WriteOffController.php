<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\BusinessWithdrawal\CreateRequest;
use Illuminate\Http\Request;
use App\Contracts;
use App\Tasks;
use App\Dto;

class WriteOffController extends Controller
{

    public function create(CreateRequest $request){

        app(Contracts\CreateBusinessWithdrawal::class)->execute(
            Dto\Business\BusinessWithdrawal\CreateDtoFactory::fromRequest($request)
        );

        return response()->noContent();
    }

}
