<?php

namespace App\Tasks\BusinessCategory;

use App\Repositories\BusinessCategoryRepositoryInterface;

class CreateOrUpdateTask{

    private BusinessCategoryRepositoryInterface $categoryRepository;

    public function __construct(BusinessCategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $payload
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function run(array $payload){
        return $this->categoryRepository->create($payload);
    }

}
