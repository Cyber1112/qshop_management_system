<?php

namespace App\Http\Controllers\User\Business;

use App\Http\Controllers\Controller;
use App\Models\TransactionHistory;
use Illuminate\Http\Request;
use App\Contracts;

class TransactionHistoryCommentController extends Controller
{
    public function create(Request $request, TransactionHistory $history){
        app(Contracts\CreateTransactionHistoryComment::class)->execute(
            $history,
            $request->comment
        );
    }
}
