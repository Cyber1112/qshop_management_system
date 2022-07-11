<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\ChildCategory;
use App\Models\ParentCategory;
use Illuminate\Http\Request;
use App\Http\Resources;

class ChildCategoryController extends Controller
{

    public function get(Request $request, ParentCategory $category){
        return Resources\Category\ChildCategoryResource::collection(ChildCategory::where('category_id', $category->id)->get());
    }

}
