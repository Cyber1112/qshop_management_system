<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\BonusOption\CreateRequest;
use App\Models\BusinessBonusOption;
use Illuminate\Http\Request;
use App\Contracts;
use App\Dto;
use Illuminate\Http\Response;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources;

class BonusOptionsController extends Controller
{

    public function get(Request $request){
        $business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
        return new Resources\User\Business\BonusOption\InfoResource(BusinessBonusOption::where('business_id', $business_id)->first());
    }

    public function createOrUpdate(CreateRequest $request): Response
    {
        app(Contracts\CreateBusinessBonusOption::class)->execute(
            Dto\Business\BusinessBonusOption\CreateDtoFactory::fromRequest($request)
        );
        return response()->noContent();
    }


}
