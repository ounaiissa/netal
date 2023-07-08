<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\JobBoardController;
use App\Models\Portfolio;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'getData']);
Route::get('/users/{id}', [UserController::class, 'getUserData']);
Route::get('/portfolios', [PortfolioController::class, 'getData']);
Route::delete('/portfolios/{id}', [PortfolioController::class, 'deletePortfolio']);
Route::put('/portfolios/{id}', [PortfolioController::class, 'edit']);
// Route::put('/portfolios/{id}', [PortfolioController::class, 'editPortfolio']);
Route::get('/jobboards', [JobBoardController::class, 'getData']);
Route::put('/jobboards/{id}', [JobBoardController::class, 'update']);

Route::post('/interested-users', [JobBoardController::class, 'storeInterestedUser']);
Route::get('/jobboards/{jobboardId}/interested-users', [JobBoardController::class, 'getInterestedUsers']);



// Route::get('/jobboards/{jobBoardId}', [JobBoardController::class, 'show'])->name('proposals');
