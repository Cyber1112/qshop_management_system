<?php

namespace App\Tasks\ChildCategory;

use App\Repositories\ChildCategoryRepositoryInterface;

class GetAllChildCategories{

    private ChildCategoryRepositoryInterface $childCategoryRepository;

    public function __construct(ChildCategoryRepositoryInterface $childCategoryRepository){
        $this->childCategoryRepository = $childCategoryRepository;
    }

    /**
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function run(array $columns){
        return $this->childCategoryRepository->getAll($columns);
    }

}
