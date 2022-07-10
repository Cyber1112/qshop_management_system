<?php

namespace App\Repositories\Eloquent;

use App\Models\ChildCategory;
use App\Repositories\ChildCategoryRepositoryInterface;

class ChildCategoryRepository extends BaseRepository implements ChildCategoryRepositoryInterface{

    public function __construct(ChildCategory $model){
        $this->model = $model;
    }

}
