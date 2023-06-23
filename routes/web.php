<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioController;
use App\Models\Portfolio;
use Illuminate\Http\Request;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});




// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// }, [PortfolioController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::get('/dashboard', function () {
    $portfolios = Portfolio::where('user_id', auth()->user()->id)->get();
    return Inertia::render('Dashboard', ['portfolios' => $portfolios]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/dashboard', [PortfolioController::class, 'store'])->middleware(['auth', 'verified'])->name('portfolio.store');

//Route::post('/dashboard', [DashboardController::class, 'store'])->middleware(['auth', 'verified'])->name('dashboard.store');

Route::get('/portfolioImages/{image}', [PortfolioController::class, 'getImage'])->middleware(['auth', 'verified'])->name('portfolioImages.getImage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/components/buttons', function () {
    return Inertia::render('Components/Buttons');
})->middleware(['auth', 'verified'])->name('components.buttons');


Route::get('/chat', function () {
    return \Inertia\Inertia::render('Chat/ChatContainer');
})->middleware(['auth', 'verified'])->name('chat');

Route::get('/private', function () {
    return \Inertia\Inertia::render('Chat/PrivateChat');
})->middleware(['auth', 'verified'])->name('private');

Route::get('/portfolio', function () {
    return \Inertia\Inertia::render('portfolio/PortfolioInput');
})->middleware(['auth', 'verified'])->name('portfolio');

Route::get('portfolios', function () {
    return \Inertia\Inertia::render('discover/portfolios/otherPortfolio');
})->middleware(['auth', 'verified'])->name('portfolios');



// Route::get('/chat/room', function () {
//     return \Inertia\Inertia::render('Chat/ChatRoomSelection');
// })->middleware(['auth', 'verified'])->name('room');


// Route::middleware(['auth', 'verified'])->get('/chat/rooms', [ChatController::class,  'rooms']); //rooms is the function
Route::get('/chat/rooms', [ChatController::class,  'rooms'])->middleware(['auth', 'verified']);
Route::get('/chat/room/{roomId}/messages', [ChatController::class,  'messages'])->middleware(['auth', 'verified']);
Route::post("/chat/room/{roomId}/message", [ChatController::class, 'newMessage'])->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
