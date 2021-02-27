<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['web'])->group(function () {


    Route::get('/', [\App\Http\Controllers\AppController::class, 'actionCheckLogin'])->name("auth.login.check");
    Route::get('/logout', [\App\Http\Controllers\AppController::class, 'actionLogout'])->name("auth.logout");


    Route::get('/login', [\App\Http\Controllers\AppController::class, 'actionLogin'])->name("auth.login");
    Route::post('/login/submit', [\App\Http\Controllers\AppController::class, 'actionLoginSubmit'])->name("auth.login.submit");

    Route::get('/verify', [\App\Http\Controllers\AppController::class, 'actionVerify'])->name("auth.verify");
    Route::post('/verify/submit', [\App\Http\Controllers\AppController::class, 'actionVerifySubmit'])->name("auth.verify.submit");


    Route::middleware(['auth.custom'])->group(function () {
        Route::prefix('dashboard/')->group(function () {
            Route::post('files/upload', [\App\Http\Controllers\AppController::class, 'actionUploadFile'])->name("files.upload");
            // tickets .
            Route::prefix('tickets/')->group(function () {
                // create ticket
                Route::get('create', [\App\Http\Controllers\AppController::class, 'actionCreateTicket'])->name("tickets.create");
                Route::post('store', [\App\Http\Controllers\AppController::class, 'actionStoreTicket'])->name("tickets.store");
                Route::get('store/success', [\App\Http\Controllers\AppController::class, 'actionStoreSuccess'])->name("tickets.store.success");
                // show all tickets.
                Route::get('list', [\App\Http\Controllers\AppController::class, 'actionListTickets'])->name("tickets.list");
                Route::get('view/{model}', [\App\Http\Controllers\AppController::class, 'actionViewTicket'])->name("tickets.view");
            });
        });
    });

});



