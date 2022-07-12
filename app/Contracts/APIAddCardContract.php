<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface APIAddCardContract
{
    /**
     * @param User $user
     * @return JsonResponse|mixed
     */
    public function apply(User $user);
}
