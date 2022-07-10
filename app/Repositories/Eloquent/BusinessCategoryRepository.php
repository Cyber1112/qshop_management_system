<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessChildCategory;
use App\Repositories\BusinessCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;


class BusinessCategoryRepository extends BaseRepository implements BusinessCategoryRepositoryInterface{

    /**
     * @param BusinessChildCategory $model
     */
    public function __construct(BusinessChildCategory $model){
        $this->model = $model;
    }


    public function getBusinessByCategory(int $category_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('category_id', $category_id)
            ->join('businesses', 'businesses.id', '=', 'business_id')
            ->join('business_bonus_options', 'business_bonus_options.business_id', '=', 'businesses.id')
            ->get();

    }

    /**
     * @param int $business_id
     * @return bool|null
     */
    public function deleteAllCategoriesByBusinessId(int $business_id): ?bool
    {
        return $this->model
            ->query()
            ->where('business_id', $business_id)
            ->delete();
    }

    /**
     * @param int $business_id
     * @param array $columns
     * @return Collection
     */
    public function getBusinessCategories(int $business_id, array $columns = ['*']): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->join('child_categories', 'child_categories.id', '=', 'business_child_categories.category_id')
            ->join('businesses', 'businesses.id', '=', 'business_child_categories.business_id')
            ->get();
    }
}
