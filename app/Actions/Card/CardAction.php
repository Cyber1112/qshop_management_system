<?php

namespace App\Actions\Card;

use App\Services\Payments\TarlanPaymentService;
use Illuminate\Support\Facades\URL;

abstract class CardAction
{
    protected $request_url;
    protected $tarlan_payment_service;

    public function __construct(TarlanPaymentService $tarlan_payment_service)
    {
        $this->request_url = URL::to('/api');
        $this->tarlan_payment_service = $tarlan_payment_service;
    }
}
