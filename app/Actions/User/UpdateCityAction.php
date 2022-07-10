<?php

namespace App\Actions\User;

use App\Contracts\UpdateCity;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class UpdateCityAction implements UpdateCity {



    public function execute(int $city_id): void
    {
        app(Tasks\User\UpdateCityTask::class)->run(
            Auth::user()->id,
            ['city_id' => $city_id]
        );
    }
}
