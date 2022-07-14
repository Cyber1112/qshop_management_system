<?php

namespace App\Http\Controllers\User\Business;

use App\Contracts\APIAddCardContract;
use App\Contracts\APIDeleteCardContract;
use App\Contracts\APIGetAllCardsContract;
use App\Http\Controllers\Controller;
use App\Http\Resources\Card\CardAddResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{

    protected APIAddCardContract $add_card_action;
    protected APIDeleteCardContract $delete_card_action;
    protected APIGetAllCardsContract $get_all_cards_action;

    public function __construct(APIAddCardContract $add_card_action, APIGetAllCardsContract $get_all_cards_action, APIDeleteCardContract $delete_card_action)
    {
        $this->add_card_action = $add_card_action;
        $this->delete_card_action = $delete_card_action;
        $this->get_all_cards_action = $get_all_cards_action;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $response = $this->get_all_cards_action->apply(User::find(Auth::user()->id));

        if(is_array($response)) {
            return response()->json($response, 200);
        }
    }

    /**
     * @return CardAddResource
     */
    public function add()
    {
        $response = $this->add_card_action->apply(User::find(Auth::user()->id)->first());

        if(is_array($response)) {
            return new CardAddResource($response);
        }
    }

    /**
     * @param $card_id
     * @return JsonResponse
     */
    public function delete($card_id)
    {
        $response = $this->delete_card_action->apply(User::find(Auth::user()->id)->first(), $card_id);

        if(!$response){
            return response()->json([], 200);
        }
    }

}
