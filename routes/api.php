<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BooksController;
use App\Http\Controllers\Api\v1\BorrowController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Api\v1\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
    });
    Route::middleware(['auth:api'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);

        Route::get('me', [ProfileController::class, 'index']);
        Route::post('profile', [ProfileController::class, 'create']);

        Route::resource('role', RoleController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('books', BooksController::class);
        Route::get('borrow',[BorrowController::class,'index']);
        Route::post('borrow',[BorrowController::class,'store']);
    });
});