<?php

namespace App\Actions\BusinessPayment;

use App\Contracts\CreateBusinessPayment;
use App\Dto\Business\BusinessPayment\CreateDto;
use App\Helpers;
use App\Tasks;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateAction implements CreateBusinessPayment {

    protected $business_id;

    public function __construct(){
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {
        $this->ensureThatCanManipulateBonus();

        $client = app(Tasks\User\FindByPhoneTask::class)->run($dto->phone_number);

        $this->ensureThatUserExists($client);
        $this->ensureThatBalanceIsEnough($dto->cash);

        $client_id = $this->getClientId($client->id);

        $bonus_option = $this->getBonusOptions();

        $this->writeOffCashFromBusiness($dto->cash);

        $this->createBusinessClientBonus(
            $this->setBonusAmount($dto->bonus_percent, $dto->cash),
            $this->setDate($bonus_option['activation_bonus_period']),
            $this->setDeactivationDate($bonus_option),
            $client_id
        );

        $transaction = $this->createTransactionHistory(
            $dto->bonus_percent,
            $dto->cash,
            $dto->task,
            $client_id
        );

        if($dto->comment){
            $this->setCommentToTransactionHistory($transaction->id, $dto->comment);
        }

    }

    public function ensureThatUserExists($user){
        if (!$user){
            throw new NotFoundHttpException("The client is not found");
        }
    }

    public function ensureThatBalanceIsEnough($cash){
        if (app(Tasks\BusinessAccount\FindBusinessTask::class)->run($this->business_id)->balance < $cash) {
            throw new AccessDeniedHttpException("Not enough money");
        }
    }

    public function createTransactionHistory(int $bonus_percent, int $cash, string $task, $client_id){
        return app(Tasks\BusinessTransactionHistory\CreateTask::class)->run([
            'bonus_percent' => $bonus_percent,
            'cash' => $cash,
            'task' => $task,
            'client_id' => $client_id,
            'business_id' => $this->business_id
        ]);
    }

    public function getBonusOptions(){
        return app(Tasks\BusinessBonusOption\FindByBusinessIdTask::class)->run($this->business_id);
    }

    public function setDate($days){
        return Carbon::now()->addDays($days);
    }

    public function setBonusAmount($bonus_percent, $cash): int
    {
        return (int) (($bonus_percent*$cash)/100);
    }

    public function setDeactivationDate($bonus_option){
        return $bonus_option['deactivation_bonus_period'] == null ? null : $this->setDate($bonus_option['deactivation_bonus_period'] + $bonus_option['activation_bonus_period']);
    }

    public function createBusinessClientBonus($cash, $activation_bonus_date, $deactivation_bonus_date, $client_id){
        app(Tasks\BusinessClientBonus\CreateTask::class)->run([
            'balance' => $cash,
            'activation_bonus_date' => $activation_bonus_date,
            'deactivation_bonus_date' => $deactivation_bonus_date,
            'business_id' => $this->business_id,
            'client_id' => $client_id
        ]);
    }

    public function writeOffCashFromBusiness(int $cash){
        app(Tasks\BusinessAccount\WriteOffCashTask::class)->run(
            $this->business_id,
            $cash
        );
    }

    public function setCommentToTransactionHistory($transaction_id, $comment){
        app(Tasks\TransactionHistoryComment\CreateTask::class)->run([
            'transaction_history_id' => $transaction_id,
            'comment' => $comment
        ]);
    }

    public function getClientId(int $user_id): int
    {
        return app(Tasks\ClientAccount\FindByClientIdTask::class)->run($user_id)->id;
    }

    public function ensureThatCanManipulateBonus(){
        if(!Auth::user()->hasPermissionTo('manipulate bonus')){
            throw new AccessDeniedHttpException("You do not have permission to manipulate bonus");
        }
    }

}
