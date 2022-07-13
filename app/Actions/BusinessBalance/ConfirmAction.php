<?php

namespace App\Actions\BusinessBalance;

use App\Contracts\APIConfirmBalanceContract;
use App\Models\Business;
use App\Models\Payment;
use App\Models\User;
use App\Repositories\BusinessRepositoryInterface;
use App\Repositories\PaymentRepositoryInterface;
use App\Services\Payments\TarlanPaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ConfirmAction extends BalanceAction implements APIConfirmBalanceContract {

    protected $business_id;

    public function __construct(BusinessRepositoryInterface $businessBalanceRepository, PaymentRepositoryInterface $paymentRepository, TarlanPaymentService $tarlan_payment_service)
    {
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
        parent::__construct($businessBalanceRepository, $paymentRepository, $tarlan_payment_service);
    }

    /**
     * @param User $user
     * @param $card_id
     * @param $cash
     * @return JsonResponse
     * @throws \Throwable
     */
    public function apply(User $user, $card_id, $cash)
    {

        $this->ensureThatCanReplenishBalance();

        /** @var Payment $payment */
        $payment = $this->payment_repository->create([
            'user_id' => $user->id,
            'business_id' => $this->business_id,
            'amount' => $cash,
            'description' => 'Пополнение баланса',
            'phone_number' => $user->phone_number,
        ]);

        $payment_response = $this->tarlan_payment_service->handlePaymentByCard($payment, $card_id);

        if (isset($payment_response['success']) && $payment_response['success'])
        {

            $business = Business::find($this->business_id)->first();

            $this->businessBalanceRepository->accrueBalance($business->id, $cash);

            $payment->paid($business, Business::NAMESPACE);



        }elseif(!isset($payment_response['success'])) {
            return response()->json(['message' => 'Ошибка на стороне платежной системы!'], 422)->send();
        }else{
            return response()->json(['message' => $payment_response['message']], 422)->send();
        }
    }


    public function ensureThatCanReplenishBalance(){
        if(!Auth::user()->hasPermissionTo('replenish balance')){
            throw new AccessDeniedHttpException("You do not have permission to replenish balance");
        }
    }

}
