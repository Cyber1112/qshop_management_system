<?php

namespace App\Repositories\Eloquent;

use App\Models\Business;
use App\Repositories\BusinessRepositoryInterface;

class BusinessRepository extends BaseRepository implements BusinessRepositoryInterface{

    public function __construct(Business $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $user_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Business|null
     */
    public function getBusinessByUserId(
        int $user_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): ?Business
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('user_id', $user_id)
            ->with($relations)
            ->withCount($relations_count)
            ->first();
    }


    /**
     * @param int $business_id
     * @param string $business_name
     * @return int
     */
    public function updateBusinessName(int $business_id, string $business_name): int
    {
        return $this->model
            ->query()
            ->where('id', $business_id)
            ->update(['business_name' => $business_name]);
    }

    /**
     * @param int $business_id
     * @param int $cash
     * @return int|null
     */
    public function writeOffCash(int $business_id, int $cash): ?int
    {
        return $this->model
            ->query()
            ->where('id', $business_id)
            ->decrement('balance', $cash);
    }

    public function accrueBalance(int $business_id, int $cash): ?int
    {
        return $this->model
            ->query()
            ->where('id', $business_id)
            ->increment('balance', $cash);
    }

}
