<?php

namespace App\Providers;

use App\Actions as Actions;
use App\Contracts as Contracts;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public array $singletons = [

//        Auth
        Contracts\Logout::class => Actions\LogoutAction::class,
        Contracts\Login::class => Actions\Login\CreateAction::class,

//        BUSINESS
        Contracts\UpdateBusinessProfile::class => Actions\Business\UpdateProfileAction::class,
        Contracts\DeleteAvatar::class => Actions\Business\DeleteAvatarAction::class,
        Contracts\CreateBusinessDescription::class => Actions\BusinessDescription\CreateAction::class,
        Contracts\UpdateBusinessDescription::class => Actions\BusinessDescription\UpdateAction::class,
        Contracts\UpdateCity::class => Actions\User\UpdateCityAction::class,
        Contracts\CreateBusinessContacts::class => Actions\BusinessContacts\CreateAction::class,
        Contracts\UpdateBusinessContacts::class => Actions\BusinessContacts\UpdateAction::class,
        Contracts\CreateBusinessSchedule::class => Actions\BusinessSchedule\CreateAction::class,
        Contracts\UpdateBusinessSchedule::class => Actions\BusinessSchedule\UpdateAction::class,
        Contracts\CreateOrUpdateBusinessCategories::class => Actions\BusinessCategory\CreateOrUpdateOrUpdateAction::class,
        Contracts\GetBusinessCategories::class => Actions\BusinessCategory\GetBusinessCategoriesAction::class,
        Contracts\CreateEmployee::class => Actions\BusinessEmployee\CreateAction::class,
        Contracts\GetBusinessEmployees::class => Actions\BusinessEmployee\GetEmployeesAction::class,
        Contracts\CreateBusinessBonusOption::class => Actions\BusinessBonusOption\CreateAction::class,
        Contracts\CreateBusinessPayment::class => Actions\BusinessPayment\CreateAction::class,
        Contracts\CreateBusinessWithdrawal::class => Actions\BusinessWithdrawal\CreateAction::class,
        Contracts\GetTransactionsHistoryBetweenDate::class => Actions\TransactionsHistory\GetBetweenDateAction::class,
        Contracts\GetAllTransactionsHistoryBetweenDate::class => Actions\TransactionsHistory\GetAllBetweenDateAction::class,
        Contracts\GetBusinessClients::class => Actions\BusinessClients\GetAction::class,
        Contracts\GetClientDetailedPage::class => Actions\TransactionsHistory\GetClientDetailedPageAction::class,
        Contracts\GetClientAllDetailsPage::class => Actions\TransactionsHistory\GetClientAllDetailsPageAction::class,
        Contracts\GetBusinessStatistics::class => Actions\BusinessStatistics\GetAction::class,
        Contracts\CreateTransactionHistoryComment::class => Actions\TransactionHistoryComment\CreateAction::class,

//        CLIENT
        Contracts\GetClientPartners::class => Actions\ClientPartners\GetAction::class,
        Contracts\GetClientTransactionsHistory::class => Actions\ClientTransactionsHistory\GetAction::class,
        Contracts\GetClientCategoriesOfBusinesses::class => Actions\ClientCategoriesOfBusinesses\GetAction::class,
        Contracts\UpdateClientProfile::class => Actions\Client\UpdateProfileAction::class,
        Contracts\GetClientUnactivatedBonus::class => Actions\ClientPartners\GetUnactivatedBonusAction::class,
        Contracts\GetClientMainPage::class => Actions\Client\GetAction::class,


//        CARD
        Contracts\APIGetAllCardsContract::class => Actions\Card\GetAllAction::class,
        Contracts\APIAddCardContract::class => Actions\Card\AddAction::class,
        Contracts\APIDeleteCardContract::class => Actions\Card\DeleteAction::class,

        Contracts\APIConfirmBalanceContract::class => Actions\BusinessBalance\ConfirmAction::class,
        Contracts\APIChooseCardContract::class => Actions\BusinessBalance\ChooseCardAction::class,
    ];
}
