<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Login\CreateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Contracts;

class LoginController extends Controller
{

    public function login(CreateRequest $request): JsonResponse
    {
        $response = app(Contracts\Login::class)->execute(
            $request->get('phone_number'),
            $request->get('password')
        );

        return response()->json($response);
    }

}
