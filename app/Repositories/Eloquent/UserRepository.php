<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

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
    ): ?User
    {
        return $this->model
            ->query()
            ->select($columns)
            ->where('phone_number', $phone_number)
            ->with($relations)
            ->withCount($relations_count)
            ->first();
    }

}
