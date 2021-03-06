<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use App\Contracts;
use App\Http\Resources;
use App\Helpers\PaginationHelper;

class TransactionsHistoryController extends Controller
{

    public function getDetail(Request $request, TransactionHistory $history){
        return new Resources\User\Client\TransactionDetailResource($history);
    }

    public function getAll(Request $request){
       $data = app(Contracts\GetClientTransactionsHistory::class)->execute(
           $request->from,
           $request->to
       );
       return PaginationHelper::paginate($data, 7);
    }

}
