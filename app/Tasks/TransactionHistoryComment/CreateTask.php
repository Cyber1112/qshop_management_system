<?php

namespace App\Tasks\TransactionHistoryComment;

use App\Repositories\TransactionHistoryCommentRepositoryInterface;

class CreateTask{

    private TransactionHistoryCommentRepositoryInterface $commentRepository;

    public function __construct(TransactionHistoryCommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function run(array $payload){
        return $this->commentRepository->create($payload);
    }

}
