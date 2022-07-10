<?php

namespace App\Actions\BusinessCategory;

use App\Contracts\GetBusinessCategories;
use App\Helpers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Tasks;

class GetBusinessCategoriesAction implements GetBusinessCategories {

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(): Collection
    {
        $business_categories = $this->getBusinessCategories();
        $all_categories = $this->getAllCategories();

        return $business_categories->union($all_categories)->values();
    }

    public function getBusinessCategories(): Collection{
        return app(Tasks\BusinessCategory\GetBusinessCategoriesTask::class)->run(
            $this->business_id,
            ['business_child_categories.category_id', 'child_categories.category_name']
        )->mapWithKeys(function ($row){
            return [
                $row['category_id'] => [
                    'category_id' => $row['category_id'],
                    'category_name' => $row['category_name'],
                    'is_used' => 'used'
                ]
            ];
        });
    }

    public function getAllCategories(): Collection{
        return app(Tasks\ChildCategory\GetAllChildCategories::class)->run(
            ['id as category_id', 'category_name']
        )->mapWithKeys(function ($row){
            return [
                $row['category_id'] => [
                    'category_id' => $row['category_id'],
                    'category_name' => $row['category_name'],
                    'is_used' => 'not_used'
                ]
            ];
        });
    }


}
