<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Contracts;
use App\Http\Resources;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index(Request $request){
        return new Resources\User\Business\Account\ProfileResource(User::find(Auth::user()->id));
    }

    public function update(Request $request): Response
    {
        app(Contracts\UpdateBusinessProfile::class)->execute(
            $request
        );

        return response()->noContent();
    }

    public function deleteAvatar(Request $request): Response
    {
        app(Contracts\DeleteBusinessAvatar::class)->execute();

        return response()->noContent();
    }


}
