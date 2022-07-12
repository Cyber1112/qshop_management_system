<?php

namespace App\Actions\BusinessBalance;


use App\Repositories\BusinessRepositoryInterface;
use App\Repositories\PaymentRepositoryInterface;
use App\Services\Payments\TarlanPaymentService;

abstract class BalanceAction
{
    protected $businessBalanceRepository;
    protected $payment_repository;

    protected $tarlan_payment_service;

    public function __construct(BusinessRepositoryInterface $businessBalanceRepository, PaymentRepositoryInterface $paymentRepository, TarlanPaymentService $tarlan_payment_service)
    {
        $this->businessBalanceRepository = $businessBalanceRepository;
        $this->payment_repository = $paymentRepository;

        $this->tarlan_payment_service = $tarlan_payment_service;
    }
}
