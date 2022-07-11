<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;

class LogoutController extends Controller
{
    public function logout(Request $request){
       app(Contracts\Logout::class)->execute();
    }
}
