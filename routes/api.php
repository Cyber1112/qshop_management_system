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

    Route::group(['prefix' => 'business', 'middleware' => ['role:business|employee']], function(){
        Route::get('about', [AboutBusinessController::class, 'get']);

        Route::group(['prefix' => 'account'], function(){
            Route::get('/get', [BusinessProfileController::class, 'index']);
            Route::group(['middleware' => 'can:edit profile'], function (){
                Route::post('/update', [BusinessProfileController::class, 'update']);
                Route::delete('/delete', [BusinessProfileController::class, 'deleteAvatar']);
            });
        });

        Route::group(['prefix' => 'card', 'middleware' => 'can:replenish balance'], function (){
            Route::get('/get', [CardController::class, 'index']);
            Route::post('/add', [CardController::class, 'add']);
            Route::delete('/delete/{card_id}', [CardController::class, 'delete']);
        });

        Route::group(['prefix' => 'accrue-balance', 'middleware' => 'can:replenish balance'], function (){
            Route::post('/choose-card', [BalanceController::class, 'chooseCard']);
            Route::post('/confirm', [BalanceController::class, 'confirm']);
        });

        Route::group(['prefix' => 'balance'], function(){
            Route::get('get', [BalanceController::class, 'getBalance']);
            Route::get('get-history', [BalanceController::class, 'getHistory']);
        });

        Route::group(['prefix' => 'city'], function (){
            Route::get('get', [CityController::class, 'show']);
            Route::group(['middleware' => 'can:edit profile'], function (){
                Route::put('/set', [CityController::class, 'setCity']);
            });
        });

        Route::group(['prefix' => 'description'], function(){
            Route::get('/get/{description}', [DescriptionController::class, 'show']);
            Route::group(['middleware' => 'can:edit profile'], function(){
                Route::post('/create', [DescriptionController::class, 'create']);
                Route::put('/update/{description}', [DescriptionController::class, 'update']);
            });
        });

        Route::group(['prefix' => 'contacts'], function(){
            Route::get('/get/{contacts}', [ContactsController::class, 'show']);
            Route::group(['middleware' => 'can:edit profile'], function(){
                Route::post('/create', [ContactsController::class, 'create']);
                Route::put('/update/{contacts}', [ContactsController::class, 'update']);
            });
        });

        Route::group(['prefix' => 'schedule'], function(){
            Route::get('/get/{schedule}', [ScheduleController::class, 'show']);
            Route::group(['middleware' => 'can:edit profile'], function(){
                Route::post('/create', [ScheduleController::class, 'create']);
                Route::put('/update/{schedule}', [ScheduleController::class, 'update']);
            });
        });

        Route::group(['prefix' => 'category'], function(){
            Route::get('/get', [BusinessCategoryController::class, 'get']);
            Route::group(['middleware' => 'can:edit profile'], function(){
                Route::post('/create', [BusinessCategoryController::class, 'createOrUpdate']);
            });
        });

        Route::group(['prefix' => 'employee'], function(){
            Route::get('get', [EmployeeController::class, 'getBusinessEmployees']);
            Route::group(['middleware' => 'can:create employee'], function(){
                Route::post('/create', [EmployeeController::class, 'create']);
                Route::delete('/delete/{employee}', [EmployeeController::class, 'deleteEmployee']);
            });
        });

        Route::group(['prefix' => 'bonus-options'], function(){
            Route::get('/get', [BonusOptionsController::class, 'get']);
            Route::group(['middleware' => 'can:manipulate bonus'], function(){
                Route::post('/create', [BonusOptionsController::class, 'createOrUpdate']);
            });
        });

        Route::group(['prefix' => 'payment', 'middleware' => 'can:manipulate bonus'], function(){
            Route::post('/create', [PaymentController::class, 'create']);
        });

        Route::group(['prefix' => 'withdrawal', 'middleware' => 'can:manipulate bonus'], function(){
            Route::post('/create', [WriteOffController::class, 'create']);
        });

        Route::group(['prefix' => 'transactions'], function(){
            Route::get('/get', [BusinessTransactionsHistoryController::class, 'getBetweenDate']);
            Route::get('/get-all', [BusinessTransactionsHistoryController::class, 'getAllBetweenDate']);
            Route::get('/get-client-detail/{history}', [BusinessTransactionsHistoryController::class, 'getDetailClientTransaction']);
            Route::prefix('comment')->group(function(){
                Route::post('/create/{history}', [TransactionHistoryCommentController::class, 'create']);
            });
        });

        Route::group(['prefix' => 'clients'], function(){
            Route::get('/get', [BusinessClientController::class, 'get']);
            Route::get('/get-detail/{client}', [BusinessClientController::class, 'getClientDetail']);
            Route::get('/get-detail-all/{client}', [BusinessClientController::class, 'getClientDetailAll']);
            Route::get('/search', [BusinessClientController::class, 'search']);
        });

        Route::group(['prefix' => 'statistics'], function(){
            Route::get('/get', [StatisticsController::class, 'get']);
        });
    });

    Route::group(['prefix' => 'client', 'middleware' => 'role:client'], function(){

        Route::group(['prefix' => 'main'], function(){
            Route::get('get', [ClientMainPageController::class, 'get']);
            Route::get('get-unactivated-bonus', [ClientMainPageController::class, 'getUnactivatedBonus']);
        });

        Route::group(['prefix' => 'profile'], function(){
            Route::get('get', [ClientProfileController::class, 'index']);
            Route::post('update', [ClientProfileController::class, 'update']);
            Route::delete('delete', [ClientProfileController::class, 'deleteAvatar']);
        });

        Route::group(['prefix' => 'partners'], function(){
            Route::get('get', [ClientPartnersController::class, 'get']);
            Route::get('detail/{business}', [ClientPartnersController::class, 'showPartner']);
            Route::get('search', [ClientPartnersController::class, 'search']);
        });

        Route::group(['prefix' => 'transactions'], function(){
            Route::get('get-detail/{history}', [ClientTransactionsHistoryController::class, 'getDetail']);
            Route::get('get-all', [ClientTransactionsHistoryController::class, 'getAll']);
        });

        Route::group(['prefix' => 'category'], function(){
            Route::get('get/{category}', [ClientCategoryController::class, 'get']);
        });

    });

    Route::group(['prefix' => 'category'], function(){
        Route::get('get-parent', [ParentCategoryController::class, 'get']);
        Route::get('get-child/{category}', [ChildCategoryController::class, 'get']);
    });

    Route::post('/logout', [LogoutController::class, 'logout']);

});
