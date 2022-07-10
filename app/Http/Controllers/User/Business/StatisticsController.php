<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;

class StatisticsController extends Controller
{

    public function get(Request $request){
        return app(Contracts\GetBusinessStatistics::class)->execute($request->period);
    }

}
