<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use App\Contracts;
use App\Http\Resources;

class TransactionsHistoryController extends Controller
{

    public function getBetweenDate(Request $request){
        return app(Contracts\GetTransactionsHistoryBetweenDate::class)->execute(
            $request->from,
            $request->to
        );
    }

    public function getAllBetweenDate(Request $request){
        return app(Contracts\GetAllTransactionsHistoryBetweenDate::class)->execute(
            $request->from,
            $request->to
        );
    }

    public function getDetailClientTransaction(Request $request, TransactionHistory $history){
        return new Resources\User\Business\ClientTransactionDetail\InfoResource($history);
    }

}
