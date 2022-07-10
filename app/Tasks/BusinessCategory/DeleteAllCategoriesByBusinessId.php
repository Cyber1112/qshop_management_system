<?php

namespace App\Tasks\BusinessCategory;

use App\Repositories\BusinessCategoryRepositoryInterface;

class DeleteAllCategoriesByBusinessId{

    private BusinessCategoryRepositoryInterface $categoryRepository;

    public function __construct(BusinessCategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param int $business_id
     * @return bool|null
     */
    public function run(int $business_id){
        return $this->categoryRepository->deleteAllCategoriesByBusinessId($business_id);
    }

}
