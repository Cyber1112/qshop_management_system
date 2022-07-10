<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessDescription;
use App\Repositories\BusinessDescriptionRepositoryInterface;

class BusinessDescriptionRepository extends BaseRepository implements BusinessDescriptionRepositoryInterface{

    public function __construct(BusinessDescription $model)
    {
        $this->model = $model;
    }


}
