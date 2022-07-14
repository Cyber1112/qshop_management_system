<?php

namespace App\Actions\BusinessWithdrawal;

use App\Contracts\CreateBusinessWithdrawal;
use App\Dto\Business\BusinessWithdrawal\CreateDto;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Helpers;
use App\Tasks;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CreateAction implements CreateBusinessWithdrawal {

    protected $business_id;

    public function __construct()
    {
        $this->business_id = app(Helpers\DefineUserRole::class)->defineRole(Auth::user());
    }

    public function execute(CreateDto $dto): void
    {

        $client = app(Tasks\User\FindByPhoneTask::class)->run($dto->phone_number);

        $this->ensureThatUserExists($client);

        $client_id = $this->getClientId($client->id);

        $data = $this->getBusinessClientData($client_id);

        $this->ensureThatHasEnoughBonus($data, $dto->cash);

        $total = $dto->cash;
        $count = 0;

        while ($total > 0){
            if ($data[$count]['balance'] > $total) {
                app(Tasks\BusinessClientBonus\UpdateTask::class)->run($data[$count]['id'], $data[$count]['balance'] - $total);
                break;
            }
            app(Tasks\BusinessClientBonus\DeleteClientBonusTask::class)->run($data[$count]['id']);
            $total -= $data[$count]['balance'];

            $count += 1;
        }

        $transaction = $this->setTransactionHistory($dto->cash, $dto->task, $client_id);

        if($dto->comment){
            $this->setCommentToTransactionHistory($transaction->id, $dto->comment);
        }

    }

    public function ensureThatHasEnoughBonus($data, $bonus){
        $cash = $data->sum('balance');
        if ($cash < $bonus){
            throw new AccessDeniedHttpException("Not enough bonus");
        }
    }

    public function setTransactionHistory(int $cash, string $task, int $client_id){

        return app(Tasks\BusinessTransactionHistory\CreateTask::class)->run([
            'cash' => $cash,
            'task' => $task,
            'client_id' => $client_id,
            'business_id' => $this->business_id
        ]);

    }

    public function getBusinessClientData($client_id): Collection{
        return app(Tasks\BusinessClientBonus\GetBusinessClientUnusedBonusTask::class)->run($client_id, $this->business_id);
    }


    public function getClientId($user_id): int
    {
        return app(Tasks\ClientAccount\FindByClientIdTask::class)->run($user_id)->id;
    }

    public function ensureThatUserExists($user){
        if (!$user){
            throw new NotFoundHttpException("The user is not found");
        }
    }

    public function setCommentToTransactionHistory($transaction_id, $comment){
        app(Tasks\TransactionHistoryComment\CreateTask::class)->run([
            'transaction_history_id' => $transaction_id,
            'comment' => $comment
        ]);
    }

}
