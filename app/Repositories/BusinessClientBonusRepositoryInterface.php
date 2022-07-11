<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface BusinessClientBonusRepositoryInterface extends EloquentRepositoryInterface{

    /**
     * @param int $client_id
     * @param int $business_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Collection
     */
    public function getClientUnusedBonus(
        int $client_id,
        int $business_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): Collection;


    /**
     * @param int $business_client_bonus_id
     * @param int $balance
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return int
     */
    public function updateClientUnusedBonus(
        int $business_client_bonus_id,
        int $balance,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): int;

    /**
     * @param int $id
     * @return bool|null
     */
    public function deleteClientBonus(
        int $id
    ): ?bool;

    public function getClientOnBusinessTotalBonus(
        int $business_id,
        int $client_id
    ):int;

    /**
     * @param int $client_id
     * @param array $columns
     * @param array $relations
     * @param array $relations_count
     * @return Collection
     */
    public function getClientPartners(
        int $client_id,
        array $columns = ['*'],
        array $relations = [],
        array $relations_count = []
    ): Collection;


    /**
     * @param int $client_id
     * @param array $columns
     * @return Collection
     */
    public function getClientActivatedBonus(
        int $client_id,
        array $columns = ['*']
    ): Collection;

    public function getClientBonuses(
        int $client_id,
        array $columns = ['*']
    ): Collection;

}
