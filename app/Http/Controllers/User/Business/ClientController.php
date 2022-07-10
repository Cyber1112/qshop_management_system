<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use App\Contracts;

class ClientController extends Controller
{

    public function get(Request $request){
        return app(Contracts\GetBusinessClients::class)->execute();
    }

    public function getClientDetail(Request $request, Client $client){
        return app(Contracts\GetClientDetailedPage::class)->execute(
            $client,
            $request->from,
            $request->to
        );
    }

    public function getClientDetailAll(Request $request, Client $client){
        return app(Contracts\GetClientAllDetailsPage::class)->execute(
            $client,
            $request->from,
            $request->to
        );
    }

}
