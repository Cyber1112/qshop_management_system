<?php

namespace App\Actions\BusinessDescription;

use App\Contracts\UpdateBusinessDescription;
use App\Models\BusinessDescription;
use App\Tasks;

class UpdateAction implements UpdateBusinessDescription {



    public function execute(string $description, BusinessDescription $businessDescription): void
    {
        app(Tasks\BusinessDescription\UpdateTask::class)->run(
            $businessDescription->id,
            ['description' => $description]
        );
    }
}
