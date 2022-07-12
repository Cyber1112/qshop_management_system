<?php

namespace App\Actions\Card;

use App\Contracts\APIGetAllCardsContract;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class GetAllAction extends CardAction implements APIGetAllCardsContract
{
    /**
     * @param User $user
     * @return array|JsonResponse
     */
    public function apply(User $user)
    {
        try {
            $response = $this->tarlan_payment_service->getCards($user);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 422)->send();
        }

        if(! $response['success']){
            return response()->json(['message' => $response['message']], 422)->send();
        }

        return $this->tarlan_payment_service->customizeApiData($response['data']);
    }
}

