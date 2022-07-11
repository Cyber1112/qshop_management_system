<?php

namespace App\Repositories;


use Illuminate\Database\Eloquent\Collection;

interface BusinessCategoryRepositoryInterface extends EloquentRepositoryInterface{

    public function getBusinessByCategory(int $category_id, array $columns = ['*']): Collection;

    /**
     * @param int $business_id
     * @return bool|null
     */
    public function deleteAllCategoriesByBusinessId(int $business_id): ?bool;

    /**
     * @param int $business_id
     * @param array $columns
     * @return Collection
     */
    public function getBusinessCategories(int $business_id, array $columns = ['*']): Collection;

    /**
     * @param int $category_id
     * @param array $columns
     * @return Collection
     */
    public function getCategoriesOfBusinesses(int $category_id, array $columns = ['*']): Collection;

}
