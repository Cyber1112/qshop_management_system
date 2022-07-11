<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use App\Http\Resources;

class ParentCategoryController extends Controller
{

    public function get(Request $request){
        return Resources\Category\ParentCategoryResource::collection(ParentCategory::all());
    }

}
