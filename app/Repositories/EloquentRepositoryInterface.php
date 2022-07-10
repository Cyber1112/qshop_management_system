<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface EloquentRepositoryInterface{

    /**
     * Get all models
     *
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Collection
     */
    public function getAll(
        array $columns = ["*"],
        array $relations = [],
        array $relations_count = []
    ): Collection;

    /**
     *
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Builder
     */
    public function getAllQuery(
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): Builder;

    /**
     * Find
     *
     * @param string $modelId
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return ?Model
     */
    public function find(
        string $modelId,
        array $columns = ["*"],
        array $relations = [],
        array $relations_count = []
    ): ?Model;

    /**
     * Find Or Fail.
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
        array $relations_count = []
    ): ?Model;

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
        array $relations_count = []
    ): ?Model;

    /**
     * Create a model.
     *
     * @param array $payload
     * @return Model
     */
    public function create(array $payload): Model;

    /**
     * Create multiple models.
     *
     * @param $values
     * @return mixed
     */
    public function insert($values): mixed;

    /**
     * Update any model.
     *
     * @param $values
     * @param $uniqueBy
     * @param null $update
     * @return int
     */
    public function upsert($values, $uniqueBy, $update = null): int;

    /**
     * @return int
     */
    public function getAllCount(): int;

    /**
     * @param int $id
     * @param array $payload
     * @return int
     */
    public function update(int $id, array $payload):int;


}
