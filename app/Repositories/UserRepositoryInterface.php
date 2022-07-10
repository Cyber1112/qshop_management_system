<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * @param string $phone_number
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return User|null
     */
    public function findByPhone(
        string $phone_number,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): ?User;


}
