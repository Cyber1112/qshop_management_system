<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessSchedule;
use App\Repositories\BusinessScheduleRepositoryInterface;

class BusinessScheduleRepository extends BaseRepository implements BusinessScheduleRepositoryInterface{

    public function __construct(BusinessSchedule $model){
        $this->model = $model;
    }

}
