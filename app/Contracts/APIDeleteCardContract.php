<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface APIDeleteCardContract
{
    /**
     * @param User $user
     * @param $card_id
     * @return JsonResponse
     */
    public function apply(User $user, $card_id);
}

