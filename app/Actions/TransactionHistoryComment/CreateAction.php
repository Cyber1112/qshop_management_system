<?php

namespace App\Actions\TransactionHistoryComment;

use App\Contracts\CreateTransactionHistoryComment;
use App\Models\TransactionHistory;
use App\Tasks;

class CreateAction implements CreateTransactionHistoryComment{

    public function execute(TransactionHistory $history, string $comment): void
    {
        app(Tasks\TransactionHistoryComment\CreateTask::class)->run([
            'transaction_history_id' => $history->id,
            'comment' => $comment
        ]);
    }
}
