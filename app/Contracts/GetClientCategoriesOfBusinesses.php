<?php

namespace App\Contracts;

use App\Models\ChildCategory;
use Illuminate\Support\Collection;

interface GetClientCategoriesOfBusinesses{

    public function execute(ChildCategory $category): Collection;

}
