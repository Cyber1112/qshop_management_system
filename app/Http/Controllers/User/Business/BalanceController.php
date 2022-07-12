<?php

namespace App\Http\Controllers\User\Business;

use App\Contracts\APIChooseCardContract;
use App\Contracts\APIConfirmBalanceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Business\Balance\APIChooseCardRequest;
use App\Http\Requests\Business\Balance\APIConfirmRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class BalanceController extends Controller
{

    protected $choose_card_action;
    protected $confirm_action;

    public function __construct(APIChooseCardContract $choose_card_action, APIConfirmBalanceContract $confirm_action)
    {
        $this->choose_card_action = $choose_card_action;
        $this->confirm_action = $confirm_action;

    }


    /**
     * @param APIChooseCardRequest $request
     * @return JsonResponse
     */
    public function chooseCard(APIChooseCardRequest $request)
    {
        $response = $this->choose_card_action->apply(User::find(Auth::user())->first(), $request->get('card_id'));

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
        $response = $this->confirm_action->apply(User::find(Auth::user())->first(), $request->get('card_id'), $request->get('cash'));

        if(!$response){
            return response()->json([], 200);
        }
    }

}
