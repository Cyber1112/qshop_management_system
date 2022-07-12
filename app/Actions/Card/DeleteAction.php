<?php

namespace App\Actions\Card;

use App\Contracts\APIDeleteCardContract;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;

class DeleteAction extends CardAction implements APIDeleteCardContract
{
    /**
     * @param User $user
     * @param $card_id
     * @return JsonResponse
     */
    public function apply(User $user, $card_id)
    {
        try {
            $delete_response = $this->tarlan_payment_service->deleteCard($user, $card_id);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 422)->send();
        }

        if(isset($delete_response['success']) && !$delete_response['success']){
            return response()->json(['message' => $delete_response['message']], 422)->send();
        }
    }
}

