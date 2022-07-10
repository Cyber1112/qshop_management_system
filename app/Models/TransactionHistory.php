<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'bonus_percent',
        'cash',
        'task',
        'business_id',
        'client_id'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function comment(){
        return $this->hasMany(TransactionHistoryComment::class);
    }

}
