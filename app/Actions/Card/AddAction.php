<?php

namespace App\Actions\Card;



use App\Contracts\APIAddCardContract;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Exception;

class AddAction extends CardAction implements APIAddCardContract
{
    /**
     * @param User $user
     * @return JsonResponse|mixed
     */
    public function apply(User $user)
    {
        try {
            $response = $this->tarlan_payment_service->addCard($user, $this->request_url);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 422)->send();
        }

        if(!$response['success']){
            return response()->json(['message' => $response['message']], 422)->send();
        }

        $response['data']['request_url'] = $this->request_url;

        return $response['data'];
    }
}
