<?php

namespace App\Contracts;

use App\Models\TransactionHistory;

interface CreateTransactionHistoryComment{

    public function execute(TransactionHistory $history, string $comment): void;

}
