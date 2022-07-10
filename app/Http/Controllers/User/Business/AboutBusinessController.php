<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Http\Resources;
use Illuminate\Support\Facades\Auth;
use App\Helpers;

class AboutBusinessController extends Controller
{

    public function get(Request $request){
        $business = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
        return new Resources\User\Business\About\InfoResource(Business::find($business));
    }

}
