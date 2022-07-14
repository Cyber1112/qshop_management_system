<?php

namespace App\Http\Controllers\User\Business;

use App\Contracts\APIChooseCardContract;
use App\Contracts\APIConfirmBalanceContract;
use App\Contracts\ApiGetCardBalanceHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Business\Balance\APIChooseCardRequest;
use App\Http\Requests\Business\Balance\APIConfirmRequest;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use App\Helpers;
use App\Http\Resources;

class BalanceController extends Controller
{

    protected APIChooseCardContract $choose_card_action;
    protected APIConfirmBalanceContract $confirm_action;
    protected ApiGetCardBalanceHistory $balanceHistory;

    public function __construct(APIChooseCardContract $choose_card_action, APIConfirmBalanceContract $confirm_action, ApiGetCardBalanceHistory $balanceHistory)
    {
        $this->choose_card_action = $choose_card_action;
        $this->confirm_action = $confirm_action;
        $this->balanceHistory = $balanceHistory;
    }


    public function getBalance(Request $request){
        $business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
        return new Resources\User\Business\Account\BalanceResource(Business::find($business_id));
    }

    public function getHistory(Request $request){
        return $this->balanceHistory->execute();
    }

    /**
     * @param APIChooseCardRequest $request
     * @return JsonResponse
     */
    public function chooseCard(APIChooseCardRequest $request)
    {
        $response = $this->choose_card_action->apply(User::find(Auth::user()->id)->first(), $request->get('card_id'));

        if(is_array($response)){
            return response()->json($response, 200);
        }
    }

    /**
     * @param APIConfirmRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function confirm(APIConfirmRequest $request)
    {
        $response = $this->confirm_action->apply(User::find(Auth::user()->id)->first(), $request->get('card_id'), $request->get('cash'));

        if(!$response){
            return response()->json([], 200);
        }
    }

}
