<?php

namespace App\Actions\BusinessBalance;

use App\Contracts\APIChooseCardContract;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class ChooseCardAction extends BalanceAction implements APIChooseCardContract
{
    /**
     * @param User $user
     * @param $card_id
     * @return array|JsonResponse
     */
    public function apply(User $user, $card_id): array|JsonResponse
    {
        $card_response = $this->tarlan_payment_service->getCard($user, $card_id);

        if(! $card_response['status']){
            return response()->json(['message' => $card_response['message']], 422)->send();
        }

        $card = $card_response['data'];

        return [
                'date' => now()->toDateString(),
                'card_type' => $card['type'],
                'card_masked_pan' => $card['masked_pan'],
            ] + request()->all();
    }
}

