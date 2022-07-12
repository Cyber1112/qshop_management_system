<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface APIConfirmBalanceContract
{
    /**
     * @param User $user
     * @param $card_id
     * @param $cash
     * @return JsonResponse
     * @throws \Throwable
     */
    public function apply(User $user, $card_id, $cash);
}

