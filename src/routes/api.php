<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [ AuthController::class, 'login' ])->name('login');

Route::post('register', [ AuthController::class, 'register' ])->name('register');

Route::get('/email/verify/{id}/{hash}', [ AuthController::class, 'verifyEmail' ])->middleware('auth:sanctum')->name('verification.verify');

Route::post('/email/verification-notification', [ AuthController::class, 'emailVerificationSend' ] )->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
