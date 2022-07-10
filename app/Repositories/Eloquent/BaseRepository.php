<?php

namespace App\Repositories\Eloquent;


use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository implements EloquentRepositoryInterface{

    protected Model $model;

    /**
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Collection
     */
    public function getAll(
        array $columns = ["*"],
        array $relations = [],
        array $relations_count = []
    ): Collection
    {
        return $this->model
            ->query()
            ->select($columns)
            ->with($relations)
            ->withCount($relations_count)
            ->latest('id')
            ->get();
    }

    /**
     * @param array|string[] $columns
     * @param array $relations
     * @param array $relations_count
     * @return Builder
     */
    public function getAllQuery(
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): Builder
    {
        return $this->model
            ->select($columns)
            ->with($relations)
            ->withCount($relations_count);
    }

    /**
     * Find by id.
     *
     * @param string $modelId
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Model|null
     */
    public function find(
        string $modelId,
        array $columns = ["*"],
        array $relations = [],
        array $relations_count = [])
    : ?Model
    {
        return $this->model
            ->query()
            ->select($columns)
            ->with($relations)
            ->withCount($relations_count)
            ->find($modelId);
    }

    /**
     * Find or fail by id.
     *
     * @param string $modelId
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Model|null
     */
    public function findOrFail(
        string $modelId,
        array $columns = ["*"],
        array $relations = [],
        array $relations_count = [])
    : ?Model
    {
        return $this->model
            ->query()
            ->select($columns)
            ->with($relations)
            ->withCount($relations_count)
            ->findOrFail($modelId);
    }

    /**
     * First where.
     *
     * @param array $condition
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Model|null
     */
    public function firstWhere(
        array $condition,
        array $columns = ["*"],
        array $relations = [],
        array $relations_count = []): ?Model
    {
        return $this->model
            ->query()
            ->select($columns)
            ->with($relations)
            ->withCount($relations_count)
            ->firstWhere($condition);
    }

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): Model
    {
        return $this->model
            ->query()
            ->create($payload);
    }

    /**
     * @param $values
     * @return mixed
     */
    public function insert($values): mixed
    {
        return $this->model
            ->query()
            ->insert($values);
    }

    /**
     * @param $values
     * @param $uniqueBy
     * @param $update
     * @return int
     */
    public function upsert($values, $uniqueBy, $update = null): int
    {
        return $this->model
            ->query()
            ->upsert($values, $uniqueBy, $update);
    }

    /**
     * @return int
     */
    public function getAllCount(): int
    {
        return $this->model
            ->query()
            ->count();
    }

    public function update(int $id, array $payload): int
    {
        return $this->model
            ->query()
            ->where('id', $id)
            ->update($payload);
    }
}
