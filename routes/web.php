<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\EmailMessageController;
use App\Http\Controllers\UserController;
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

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // user routes
    Route::resource('users', UserController::class)->middleware('is.admin');

    // country and state routes
    Route::get('/states-by-country/{countryId?}', [CityController::class, 'statesByCountry'])->name('statesByCountry');
    Route::get('/cities-by-state/{stateId?}', [CityController::class, 'citiesByState'])->name('citiesByState');

    // store email message
    Route::post('/email-messages', [EmailMessageController::class, 'store'])->name('emailMessages.store');
});
