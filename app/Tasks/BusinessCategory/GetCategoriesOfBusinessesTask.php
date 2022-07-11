<?php

namespace App\Tasks\BusinessCategory;

use App\Repositories\BusinessCategoryRepositoryInterface;

class GetCategoriesOfBusinessesTask{

    private BusinessCategoryRepositoryInterface $business_category_repository;

    public function __construct(BusinessCategoryRepositoryInterface $business_category_repository){
        $this->business_category_repository = $business_category_repository;
    }

    public function run(int $category_id, array $columns = ['*']){
        return $this->business_category_repository->getCategoriesOfBusinesses($category_id, $columns);
    }

}
