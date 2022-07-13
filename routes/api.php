<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Category\ChildCategoryController;
use App\Http\Controllers\Category\ParentCategoryController;
use App\Http\Controllers\User\Business\AboutBusinessController;
use App\Http\Controllers\User\Business\BalanceController;
use App\Http\Controllers\User\Business\BonusOptionsController;
use App\Http\Controllers\User\Business\CardController;
use App\Http\Controllers\User\Business\CategoryController as BusinessCategoryController;
use App\Http\Controllers\User\Business\ClientController as BusinessClientController;
use App\Http\Controllers\User\Business\ContactsController;
use App\Http\Controllers\User\Business\DescriptionController;
use App\Http\Controllers\User\Business\EmployeeController;
use App\Http\Controllers\User\Business\ProfileController as BusinessProfileController;
use App\Http\Controllers\User\Business\ScheduleController;
use App\Http\Controllers\User\Business\PaymentController;
use App\Http\Controllers\User\Business\StatisticsController;
use App\Http\Controllers\User\Business\TransactionHistoryCommentController;
use App\Http\Controllers\User\Business\TransactionsHistoryController as BusinessTransactionsHistoryController;
use App\Http\Controllers\User\Business\WriteOffController;
use App\Http\Controllers\User\City\CityController;
use App\Http\Controllers\User\Client\CategoryController as ClientCategoryController;
use App\Http\Controllers\User\Client\MainPageController as ClientMainPageController;
use App\Http\Controllers\User\Client\PartnersController as ClientPartnersController;
use App\Http\Controllers\User\Client\ProfileController as ClientProfileController;
use App\Http\Controllers\User\Client\TransactionsHistoryController as ClientTransactionsHistoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('business')->group(function () {
        Route::get('about', [AboutBusinessController::class, 'get']);

        Route::prefix('account')->group(function (){
            Route::get('/get', [BusinessProfileController::class, 'index']);
            Route::post('/update', [BusinessProfileController::class, 'update']);
            Route::delete('/delete', [BusinessProfileController::class, 'deleteAvatar']);
        });

        Route::prefix('card')->group(function(){
            Route::get('/get', [CardController::class, 'index']);
            Route::post('/add', [CardController::class, 'add']);
            Route::delete('/delete/{card_id}', [CardController::class, 'delete']);
        });

        Route::prefix('accrue-balance')->group(function(){
            Route::get('get', [BalanceController::class, 'get']);
            Route::post('/choose-card', [BalanceController::class, 'chooseCard']);
            Route::post('/confirm', [BalanceController::class, 'confirm']);
        });

        Route::prefix('city')->group(function(){
            Route::get('get', [CityController::class, 'show']);
            Route::put('/set', [CityController::class, 'setCity']);
        });

        Route::prefix('description')->group(function(){
            Route::get('/get/{description}', [DescriptionController::class, 'show']);
            Route::post('/create', [DescriptionController::class, 'create']);
            Route::put('/update/{description}', [DescriptionController::class, 'update']);
        });

        Route::prefix('contacts')->group(function(){
            Route::get('/get/{contacts}', [ContactsController::class, 'show']);
            Route::post('/create', [ContactsController::class, 'create']);
            Route::put('/update/{contacts}', [ContactsController::class, 'update']);
        });

        Route::prefix('schedule')->group(function(){
            Route::get('/get/{schedule}', [ScheduleController::class, 'show']);
            Route::post('/create', [ScheduleController::class, 'create']);
            Route::put('/update/{schedule}', [ScheduleController::class, 'update']);
        });

        Route::prefix('category')->group(function(){
            Route::get('/get', [BusinessCategoryController::class, 'get']);
            Route::post('/create', [BusinessCategoryController::class, 'createOrUpdate']);
        });

        Route::prefix('employee')->group(function (){
            Route::get('get', [EmployeeController::class, 'getBusinessEmployees']);
            Route::post('/create', [EmployeeController::class, 'create']);
            Route::delete('/delete/{employee}', [EmployeeController::class, 'deleteEmployee']);
        });

        Route::prefix('bonus-options')->group(function (){
            Route::get('/get', [BonusOptionsController::class, 'get']);
            Route::post('/create', [BonusOptionsController::class, 'createOrUpdate']);
        });

        Route::prefix('payment')->group(function (){
            Route::post('/create', [PaymentController::class, 'create']);
        });

        Route::prefix('withdrawal')->group(function (){
            Route::post('/create', [WriteOffController::class, 'create']);
        });

        Route::prefix('transactions')->group(function(){
            Route::get('/get', [BusinessTransactionsHistoryController::class, 'getBetweenDate']);
            Route::get('/get-all', [BusinessTransactionsHistoryController::class, 'getAllBetweenDate']);
            Route::get('/get-client-detail/{history}', [BusinessTransactionsHistoryController::class, 'getDetailClientTransaction']);
            Route::prefix('comment')->group(function(){
                Route::post('/create/{history}', [TransactionHistoryCommentController::class, 'create']);
            });
        });

        Route::prefix('clients')->group(function (){
            Route::get('/get', [BusinessClientController::class, 'get']);
            Route::get('/get-detail/{client}', [BusinessClientController::class, 'getClientDetail']);
            Route::get('/get-detail-all/{client}', [BusinessClientController::class, 'getClientDetailAll']);
        });

        Route::prefix('statistics')->group(function(){
            Route::get('/get', [StatisticsController::class, 'get']);
        });
    });

    Route::prefix('client')->group(function(){

        Route::prefix('main')->group(function (){
            Route::get('get', [ClientMainPageController::class, 'get']);
            Route::get('get-unactivated-bonus', [ClientMainPageController::class, 'getUnactivatedBonus']);
        });

        Route::prefix('profile')->group(function(){
            Route::get('get', [ClientProfileController::class, 'index']);
            Route::post('update', [ClientProfileController::class, 'update']);
            Route::post('delete', [ClientProfileController::class, 'deleteAvatar']);
        });

        Route::prefix('partners')->group(function(){
            Route::get('get', [ClientPartnersController::class, 'get']);
            Route::get('detail/{business}', [ClientPartnersController::class, 'showPartner']);
        });

        Route::prefix('transactions')->group(function(){
            Route::get('get-detail/{history}', [ClientTransactionsHistoryController::class, 'getDetail']);
            Route::get('get-all', [ClientTransactionsHistoryController::class, 'getAll']);
        });

        Route::prefix('category')->group(function(){
            Route::get('get/{category}', [ClientCategoryController::class, 'get']);
        });


    });

    Route::prefix('category')->group(function(){
        Route::get('get-parent', [ParentCategoryController::class, 'get']);
        Route::get('get-child/{category}', [ChildCategoryController::class, 'get']);
    });

    Route::post('/logout', [LogoutController::class, 'logout']);

});
