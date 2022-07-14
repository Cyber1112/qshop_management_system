<?php

namespace App\Actions\BusinessCategory;

use App\Contracts\CreateOrUpdateBusinessCategories;
use App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Tasks;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CreateOrUpdateOrUpdateAction implements CreateOrUpdateBusinessCategories {

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(array $categories_id): void
    {

        $this->deleteCategories();

        foreach ($categories_id as $category_id){
            app(Tasks\BusinessCategory\CreateOrUpdateTask::class)->run(
                [
                    'category_id' => $category_id,
                    'business_id' => $this->business_id
                ]
            );
        }
    }


    public function deleteCategories(){
        app(Tasks\BusinessCategory\DeleteAllCategoriesByBusinessId::class)->run($this->business_id);
    }
}
