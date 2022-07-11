<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Contracts;
use App\Http\Resources;
use JetBrains\PhpStorm\Pure;

class PartnersController extends Controller
{
    public function get(Request $request){
        return app(Contracts\GetClientPartners::class)->execute();
    }

    public function showPartner(Request $request, Business $business): Resources\User\Client\PartnerAboutResource
    {
        return new Resources\User\Client\PartnerAboutResource($business);
    }
}
