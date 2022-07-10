<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\BusinessPayment\CreateRequest;
use Illuminate\Http\Request;
use App\Contracts;
use App\Dto;

class PaymentController extends Controller
{

    public function create(CreateRequest $request){
        app(Contracts\CreateBusinessPayment::class)->execute(
            Dto\Business\BusinessPayment\CreateDtoFactory::fromRequest($request)
        );

        return response()->noContent();
    }

}
