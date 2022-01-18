<?php

use App\Http\Controllers\User\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('user.')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});
