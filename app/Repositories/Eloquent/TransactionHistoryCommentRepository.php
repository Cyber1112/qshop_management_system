<?php

namespace App\Repositories\Eloquent;

use App\Models\TransactionHistoryComment;
use App\Repositories\TransactionHistoryCommentRepositoryInterface;

class TransactionHistoryCommentRepository extends BaseRepository implements TransactionHistoryCommentRepositoryInterface {

    public function __construct(TransactionHistoryComment $model){
        $this->model = $model;
    }

}
