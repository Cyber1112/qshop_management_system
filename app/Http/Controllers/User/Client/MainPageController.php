<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use App\Http\Resources;

class MainPageController extends Controller
{

    public function get(Request $request){
        return app(Contracts\GetClientMainPage::class)->execute();
    }

    public function getUnactivatedBonus(Request $request){
        return app(Contracts\GetClientUnactivatedBonus::class)->execute();
    }

}
