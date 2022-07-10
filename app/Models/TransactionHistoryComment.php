<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistoryComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'transaction_history_id',
    ];

    public function transactionHistory(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(TransactionHistory::class);
    }
}
