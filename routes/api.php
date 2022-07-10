<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\Business\AboutBusinessController;
use App\Http\Controllers\User\Business\BonusOptionsController;
use App\Http\Controllers\User\Business\CategoryController;
use App\Http\Controllers\User\Business\ClientController as BusinessClientController;
use App\Http\Controllers\User\Business\ContactsController;
use App\Http\Controllers\User\Business\DescriptionController;
use App\Http\Controllers\User\Business\EmployeeController;
use App\Http\Controllers\User\Business\ProfileController as BusinessProfileController;
use App\Http\Controllers\User\Business\ScheduleController;
use App\Http\Controllers\User\Business\PaymentController;
use App\Http\Controllers\User\Business\StatisticsController;
use App\Http\Controllers\User\Business\TransactionHistoryCommentController;
use App\Http\Controllers\User\Business\TransactionsHistoryController;
use App\Http\Controllers\User\Business\WriteOffController;
use App\Http\Controllers\User\City\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('business')->group(function () {
        Route::get('about', [AboutBusinessController::class, 'get']);

        Route::prefix('account')->group(function (){
            Route::get('/get', [BusinessProfileController::class, 'index']);
            Route::post('/update', [BusinessProfileController::class, 'update']);
            Route::post('/delete', [BusinessProfileController::class, 'deleteAvatar']);
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
            Route::get('/get', [CategoryController::class, 'get']);
            Route::post('/create', [CategoryController::class, 'createOrUpdate']);
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
            Route::get('/get', [TransactionsHistoryController::class, 'getBetweenDate']);
            Route::get('/get-all', [TransactionsHistoryController::class, 'getAllBetweenDate']);
            Route::get('/get-client-detail/{history}', [TransactionsHistoryController::class, 'getDetailClientTransaction']);
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

    Route::prefix('client')->group(function(){});

});
