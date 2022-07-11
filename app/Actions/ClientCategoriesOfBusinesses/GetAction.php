<?php

namespace App\Actions\ClientCategoriesOfBusinesses;

use App\Contracts\GetClientCategoriesOfBusinesses;
use App\Models\ChildCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Tasks;

class GetAction implements GetClientCategoriesOfBusinesses{

    protected $client_id;

    public function __construct(){
        $this->client_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(ChildCategory $category): Collection
    {
        return $this->joinTwoTables(
            $this->getBusinessesCategories($category->id),
            $this->getClientBusinessesBonus()
        );
    }

    public function getBusinessesCategories(int $category_id){
        $data = app(Tasks\BusinessCategory\GetCategoriesOfBusinessesTask::class)->run(
            $category_id,
            ['businesses.id as business_id', 'businesses.business_name', 'business_bonus_options.bonus_percent']
        );

        return $data->mapWithKeys(function($item, $key){
            return [
                $item['business_id'] => [
                    'business_name' => $item->business_name,
                    'bonus_percent' => $item->bonus_percent
                ]
            ];
        });
    }

    public function getClientBusinessesBonus(){
        $data = app(Tasks\BusinessClientBonus\GetClientActivatedBonusTask::class)->run(
            $this->client_id,
            ['business_id', 'balance']
        );

        return $data->groupBy('business_id')->map(function ($row){
            return [
                "balance" => $row->sum('balance')
            ];
        });
    }

    public function joinTwoTables($category, $bonus): Collection
    {
        $data = collect();


        foreach ($category->keys() as $key){
            if ($bonus->has($key)){
                $data->push([
                    'business_id' => $key,
                    'business_name' => $category[$key]['business_name'],
                    'balance' => $bonus[$key]['balance']
                ]);
            }else{
                $data->push([
                    'business_id' => $key,
                    'business_name' => $category[$key]['business_name'],
                    'bonus_amount' => $category[$key]['bonus_amount']
                ]);
            }
        }
        return $data;

    }
}
