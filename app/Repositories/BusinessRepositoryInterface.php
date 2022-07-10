<?php

namespace App\Repositories;

use App\Models\Business;

interface BusinessRepositoryInterface extends EloquentRepositoryInterface{

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
    ): ?Business;


    /**
     * @param int $business_id
     * @param string $business_name
     * @return int
     */
    public function updateBusinessName(
        int $business_id,
        string $business_name
    ):int;

    /**
     * @param int $business_id
     * @param int $cash
     * @return int|null
     */
    public function writeOffCash(int $business_id, int $cash): ?int;

}
