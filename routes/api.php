<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('/feeds', [FeedController::class, 'index']);
    Route::get('/feeds/{id}', [FeedController::class, 'show']);
    Route::post('/feeds', [FeedController::class, 'store']);
    Route::patch('/feeds/{id}', [FeedController::class, 'update'])->middleware(['feed.owner']);
    
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
