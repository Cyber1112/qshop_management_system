<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface APIGetAllCardsContract
{
    /**
     * @param User $user
     * @return array|JsonResponse
     */
    public function apply(User $user);
}
