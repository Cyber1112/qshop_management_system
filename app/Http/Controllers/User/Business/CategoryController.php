<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function get(Request $request){
        return app(Contracts\GetBusinessCategories::class)->execute();
    }

    public function createOrUpdate(Request $request): Response
    {
        app(Contracts\CreateOrUpdateBusinessCategories::class)->execute(
            $request->category
        );

        return response()->noContent();
    }

}
