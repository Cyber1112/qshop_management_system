<?php

namespace App\Services\Payments;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class TarlanPaymentService
{
    const payment_created = 0;
    const payment_success = 1;
    const payment_in_progress = 2;
    const payment_3ds_verification = 3;
    const payment_authorized = 4;
    const payment_refund = 5;
    const payment_debiting_error = 6;

    protected $baseUri;
    protected $merchant_id;
    protected $secret_key;
    protected $is_test;

    public function __construct()
    {
        $this->baseUri = config('services.tarlanpayment.baseUri');
        $this->merchant_id = 1;
        $this->secret_key = 123456;
        $this->is_test = config('services.tarlanpayment.is_test');
    }

    public function handlePayment(Payment $payment)
    {
        $secret_key = bcrypt($payment->id.$this->secret_key);

        return Http::post($this->baseUri . 'invoice/create', [
            'secret_key' => $secret_key,
            'merchant_id' => $this->merchant_id,
            'amount' => $payment->amount,
            'description' => $payment->description,
            'user_email' => $payment->email,
            'back_url' => route('payments.check', ['payment_id' => $payment->id, 'payment_hash' => $payment->hash]),
            'request_url' => $payment->request_url,
            'reference_id' => $payment->id,
            'is_test' => $this->is_test,
        ])->json();
    }

    public function refundPayment(Payment $payment, $reason)
    {
        $secret_key = bcrypt($payment->id.$this->secret_key);

        return Http::post($this->baseUri . 'payment/refund', [
            'merchant_id' => $this->merchant_id,
            'secret_key' => $secret_key,
            'reference_id' => $payment->id,
            'reason' => $reason,
            'refund_amount' => $payment->amount,
            'is_test' => $this->is_test,
        ])->json();
    }

    public function handlePaymentByCard(Payment $payment, $card_id)
    {
        $secret_key = Hash::make($payment->id.$this->secret_key);

        return Http::post($this->baseUri . 'api/invoice/api-recurrent', [
            'merchant_id' => $this->merchant_id,
            'reference_id' => $payment->id,
            'back_url' => $this->baseUri.'check.php',
            'description' => $payment->description,
            'amount' => $payment->amount,
            'secret_key' => $secret_key,
            'user_id' => $payment->user_id,
            'card_id' => $card_id,
            'user_phone' => $payment->phone,
            'user_email' => $payment->email,
            'is_test' => $this->is_test,
        ])->json();
    }

    public function getCards(User $user)
    {
        $secret_key = Hash::make($this->merchant_id . $user->id . $this->secret_key);

        return Http::get($this->baseUri . 'api/cards/payin', [
            'user_id' => $user->id,
            'merchant_id' => intval($this->merchant_id),
            'secret_key' => $secret_key,
            'is_test' => $this->is_test,
        ])->json();
    }

    public function addCard(User $user, $request_url)
    {
        $secret_key = Hash::make($this->merchant_id . $user->id . $this->secret_key);

        return Http::post($this->baseUri . 'api/invoice/card-linking', [
            'user_id' => $user->id,
            'merchant_id' => $this->merchant_id,
            'secret_key' => $secret_key,
            'is_test' => $this->is_test,
            'request_url' => $request_url,
            'back_url' => $this->baseUri."check.php",
        ])->json();
    }

    public function deleteCard(User $user, $card_id)
    {
        $secret_key = Hash::make($this->merchant_id.$user->id.$this->secret_key);

        return Http::delete($this->baseUri . 'api/cards/payin', [
            'card_id' => $card_id,
            'merchant_id' => $this->merchant_id,
            'user_id' => $user->id,
            'secret_key' => $secret_key
        ])->json();
    }

    public function getCard(User $user, $card_id) :array
    {
        $status = true;
        $message = '';
        $data = [];

        try {
            $response = $this->getCards($user);

            if(! $response['success']){
                $status = false;
                $message = $response['message'];
            }

            foreach ($response['data'] as $card){
                if($card['id'] == $card_id){
                    $data = [
                        'id' => $card['id'],
                        'masked_pan' => $card['masked_pan'],
                        'type' => str_starts_with($card['masked_pan'], '4') ? 'visa' : 'mastercard'
                    ];
                    break;
                }
            }

            if(!$data){
                $status = false;
                $message = __('Карта не найдена');
            }

        } catch (\Exception $e){
            $status = false;
            $message = $e->getMessage();
        }

        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }

    public function customizeApiData($cards)
    {
        $response = [];

        foreach ($cards as $card){
            $response[] = [
                'id' => $card['id'],
                'masked_pan' => '•••• '.substr($card['masked_pan'], strlen($card['masked_pan'])-4),
                'type' => str_starts_with($card['masked_pan'], '4') ? 'visa' : 'mastercard'
            ];
        }

        return $response;
    }
}
