<?php

namespace App\Tasks\BusinessCategory;

use App\Repositories\BusinessCategoryRepositoryInterface;

class GetBusinessCategoriesTask{

    private BusinessCategoryRepositoryInterface $categoryRepository;

    public function __construct(BusinessCategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }


    public function run(int $business_id, array $columns){
        return $this->categoryRepository->getBusinessCategories($business_id, $columns);
    }

}
