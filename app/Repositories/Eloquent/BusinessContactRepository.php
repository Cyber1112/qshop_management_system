<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessContacts;
use App\Repositories\BusinessContactRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class BusinessContactRepository extends BaseRepository implements BusinessContactRepositoryInterface {

    /**
     * @param BusinessContacts $model
     */
    public function __construct(BusinessContacts $model){
        $this->model = $model;
    }


}
