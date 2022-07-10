<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessDescription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Contracts;

class DescriptionController extends Controller
{
    public function show(Request $request, BusinessDescription $description){
        return response()->json([
            "id" => $description->id,
            "description" => $description->description
        ]);
    }

    public function create(Request $request): Response
    {
        app(Contracts\CreateBusinessDescription::class)->execute($request->description);
        return response()->noContent();
    }

    public function update(Request $request, BusinessDescription $description): Response
    {
        app(Contracts\UpdateBusinessDescription::class)->execute($request->description, $description);
        return response()->noContent();
    }

}
