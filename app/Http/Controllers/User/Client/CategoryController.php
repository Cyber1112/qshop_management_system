<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use Illuminate\Http\Request;
use App\Contracts;

class CategoryController extends Controller
{

    public function get(Request $request, ChildCategory $category){
        return app(Contracts\GetClientCategoriesOfBusinesses::class)->execute(
            $category
        );
    }

}
