<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Contracts;
use App\Http\Resources;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class ProfileController extends Controller
{

    public function index(Request $request){
        $business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
        return new Resources\User\Business\Account\ProfileResource(User::find($business_id));
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
        app(Contracts\DeleteAvatar::class)->execute();

        return response()->noContent();
    }


}
