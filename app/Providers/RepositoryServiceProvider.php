<?php

namespace App\Providers;

use App\Repositories as Repositories;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [

        Repositories\EloquentRepositoryInterface::class => Repositories\Eloquent\BaseRepository::class,
        Repositories\UserRepositoryInterface::class => Repositories\Eloquent\UserRepository::class,

        Repositories\ChildCategoryRepositoryInterface::class => Repositories\Eloquent\ChildCategoryRepository::class,

        Repositories\BusinessRepositoryInterface::class => Repositories\Eloquent\BusinessRepository::class,
        Repositories\BusinessScheduleRepositoryInterface::class => Repositories\Eloquent\BusinessScheduleRepository::class,
        Repositories\BusinessCategoryRepositoryInterface::class => Repositories\Eloquent\BusinessCategoryRepository::class,
        Repositories\BusinessDescriptionRepositoryInterface::class => Repositories\Eloquent\BusinessDescriptionRepository::class,
        Repositories\BusinessContactRepositoryInterface::class => Repositories\Eloquent\BusinessContactRepository::class,
        Repositories\EmployeeRepositoryInterface::class => Repositories\Eloquent\EmployeeRepository::class,
        Repositories\BusinessBonusOptionRepositoryInterface::class => Repositories\Eloquent\BusinessBonusOptionRepository::class,
        Repositories\BusinessClientBonusRepositoryInterface::class => Repositories\Eloquent\BusinessClientBonusRepository::class,
        Repositories\TransactionHistoryRepositoryInterface::class => Repositories\Eloquent\TransactionHistoryRepository::class,
        Repositories\ClientRepositoryInterface::class => Repositories\Eloquent\ClientRepository::class,
        Repositories\TransactionHistoryCommentRepositoryInterface::class => Repositories\Eloquent\TransactionHistoryCommentRepository::class,
        Repositories\PaymentRepositoryInterface::class => Repositories\Eloquent\PaymentRepository::class,
    ];
}
