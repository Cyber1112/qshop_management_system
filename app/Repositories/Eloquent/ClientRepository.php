<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use App\Repositories\ClientRepositoryInterface;

class ClientRepository extends BaseRepository implements ClientRepositoryInterface{

    public function __construct(Client $model){
        $this->model = $model;
    }

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
    ): ?Client
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('user_id', $user_id)
            ->with($relations)
            ->withCount($relations_count)
            ->first();
    }


}
