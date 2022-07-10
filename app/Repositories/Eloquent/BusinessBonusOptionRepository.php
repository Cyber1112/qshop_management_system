<?php

namespace App\Repositories\Eloquent;

use App\Models\BusinessBonusOption;
use App\Repositories\BusinessBonusOptionRepositoryInterface;

class BusinessBonusOptionRepository extends BaseRepository implements BusinessBonusOptionRepositoryInterface{

    public function __construct(BusinessBonusOption $model){
        $this->model = $model;
    }

    public function findByBusinessId(int $business_id, array $columns = ['*'], array $relations = [], array $relations_count = []): ?BusinessBonusOption
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('business_id', $business_id)
            ->with($relations)
            ->withCount($relations_count)
            ->first();
    }

    public function delete(int $business_id): ?bool
    {
        return $this->model
            ->query()
            ->where('business_id', $business_id)
            ->delete();
    }
}
