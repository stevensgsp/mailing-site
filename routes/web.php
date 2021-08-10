<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    // index users
    Route::get('/users', [UserController::class, 'index']);

    // store users
    Route::post('/users', [UserController::class, 'store']);

    // show user
    Route::get('/users/{id}', [UserController::class, 'show']);

    // update user
    Route::post('/users/{id}', [UserController::class, 'update']);

    // delete user
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    // store email message
    Route::post('/email-messages', [EmailMessageController::class, 'store']);
});
