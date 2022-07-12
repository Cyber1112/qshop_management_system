<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const STATUS_PAID = 'paid';
    const STATUS_NOT_PAID = 'not_paid';

    protected $fillable = [
        'user_id', 'phone', 'email', 'amount', 'description', 'hash', 'redirect_url',
        'request_url', 'status_id', 'paymentable_type', 'paymentable_id'
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }

    /**
     * @param Model|null $model
     * @param bool $namespace
     */
    public function paid(Model $model = null, $namespace = false)
    {
        if($model){
            $this->paymentable_id = $model->id;
        }

        if($namespace){
            $this->paymentable_type = $namespace;
        }

        $this->status_id = self::STATUS_PAID;
        $this->saveQuietly();
    }

    /**
     * Remove
     */
    public function remove()
    {
        $this->delete();
    }

}
