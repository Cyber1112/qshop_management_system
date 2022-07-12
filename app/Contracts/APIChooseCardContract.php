<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface APIChooseCardContract{

    /**
     * @param User $user
     * @param $card_id
     * @return array|JsonResponse
     */
    public function apply(User $user, $card_id): array|JsonResponse;

}
