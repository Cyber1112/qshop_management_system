<?php

namespace App\Repositories;

use App\Models\Client;

interface ClientRepositoryInterface extends EloquentRepositoryInterface{

    /**
     * @param int $user_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Client|null
     */
    public function findByUserId(
        int $user_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): ?Client;


    /**
     * @param int $client_id
     * @param int $cash
     * @return int|null
     */
    public function incrementBonus(
        int $client_id,
        int $cash
    ): ?int;

    /**
     * @param int $client_id
     * @param int $cash
     * @return int|null
     */
    public function decrementBonus(
        int $client_id,
        int $cash
    ): ?int;
}
