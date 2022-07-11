<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources;
use App\Contracts;

class ProfileController extends Controller
{

    public function index(Request $request){
        return new Resources\User\Client\ProfileResource(User::find(Auth::user()->id));
    }

    public function update(Request $request): Response
    {
        app(Contracts\UpdateClientProfile::class)->execute(
            $request
        );

        return response()->noContent();
    }

    public function deleteAvatar(Request $request): Response
    {
        app(Contracts\DeleteAvatar::class)->execute();

        return response()->noContent();
    }
}
