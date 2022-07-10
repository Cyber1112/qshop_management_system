<?php

namespace App\Http\Controllers\User\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Contracts;

class CityController extends Controller
{
    public function show(Request $request){
        return City::select('id', 'city')->get();
    }

    public function setCity(Request $request){
        app(Contracts\UpdateCity::class)->execute($request->city_id);
    }
}
