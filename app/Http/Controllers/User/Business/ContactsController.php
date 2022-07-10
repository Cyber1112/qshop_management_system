<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Http\Requests\Business\Contacts\CreateRequest;
use App\Models\BusinessContacts;
use Illuminate\Http\Request;
use App\Contracts;
use App\Dto;

class ContactsController extends Controller
{

    public function show(Request $request, BusinessContacts $contacts){
        return response()->json([
            "id" => $contacts->id,
            "address" => $contacts->address,
            "phone_number" => $contacts->phone_number,
            "site_location" => $contacts->site_location
        ]);
    }

    public function create(CreateRequest $request){

        app(Contracts\CreateBusinessContacts::class)->execute(
            Dto\Business\BusinessContacts\CreateDtoFactory::fromRequest($request)
        );

        return response()->noContent();
    }

    public function update(CreateRequest $request, BusinessContacts $contacts){
        app(Contracts\UpdateBusinessContacts::class)->execute(
            Dto\Business\BusinessContacts\CreateDtoFactory::fromRequest($request),
            $contacts
        );
    }

}
