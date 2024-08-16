<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\VerificationController;

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


Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('email/verify', [VerificationController::class, 'show'])->middleware('auth:api')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->middleware(['auth:api', 'signed'])->name('verification.verify');
Route::post('email/send', [VerificationController::class, 'send'])->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');
Route::post('email/resend', [VerificationController::class, 'resend'])->middleware(['auth:api', 'throttle:6,1'])->name('verification.resend');

Route::middleware('auth:api')->group(function () {
    Route::get('member-plans', [AuthController::class, 'memberPlans']);

    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);

    // Trainer
    Route::middleware('trainer')->prefix('trainer')->group(function () {
        Route::group(['middleware' => 'can:manage_user'], function () {
            Route::get('/users', [UserController::class, 'list']);
            Route::post('/user/create', [UserController::class, 'store']);
            Route::get('/user/{id}', [UserController::class, 'profile']);
            Route::get('/user/delete/{id}', [UserController::class, 'delete']);
            Route::post('/user/change-role/{id}', [UserController::class, 'changeRole']);
        });

        Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
            Route::get('/roles', [RolesController::class, 'list']);
            Route::post('/role/create', [RolesController::class, 'store']);
            Route::get('/role/{id}', [RolesController::class, 'show']);
            Route::get('/role/delete/{id}', [RolesController::class, 'delete']);
            Route::post('/role/change-permission/{id}', [RolesController::class, 'changePermissions']);
        });

        Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
            Route::get('/permissions', [PermissionController::class, 'list']);
            Route::post('/permission/create', [PermissionController::class, 'store']);
            Route::get('/permission/{id}', [PermissionController::class, 'show']);
            Route::get('/permission/delete/{id}', [PermissionController::class, 'delete']);
        });
    });

    // Customer
    Route::middleware('customer')->prefix('customer')->group(function () {
    });
});
