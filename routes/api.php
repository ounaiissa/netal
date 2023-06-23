<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PortfolioController;
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
Route::get('/portfolios', [PortfolioController::class, 'getData']);
Route::delete('/portfolios/{id}', [PortfolioController::class, 'deletePortfolio']);
Route::put('/portfolios/{id}', [PortfolioController::class, 'edit']);
// Route::put('/portfolios/{id}', [PortfolioController::class, 'editPortfolio']);
