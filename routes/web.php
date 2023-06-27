<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    Route::get('/user', function () {
        return Inertia::render('Dashboard');
    })->name('user');
    Route::match(['get', 'post'], '/user/create', function () {
        return Inertia::render('CreatePage');
    })->name('user.store');
    Route::match(['get', 'put'], '/user/update/{uuid}', function () {
        return Inertia::render('EditPage');
    })->name('user.update');

    Route::get('/sub', function () {
        return Inertia::render('Dashboard');
    })->name('sub');
    Route::post('/sub', function () {
        return Inertia::render('Dashboard');
    })->name('sub.store');
    Route::put('/sub', function () {
        return Inertia::render('Dashboard');
    })->name('sub.update');

    Route::get('/post', function () {
        return Inertia::render('Dashboard');
    })->name('post');
    Route::post('/post', function () {
        return Inertia::render('Dashboard');
    })->name('post.store');
    Route::put('/post', function () {
        return Inertia::render('Dashboard');
    })->name('post.update');

    Route::get('/plan', function () {
        return Inertia::render('Dashboard');
    })->name('plan');
    Route::post('/plan', function () {
        return Inertia::render('Dashboard');
    })->name('plan.store');
    Route::put('/plan', function () {
        return Inertia::render('Dashboard');
    })->name('plan.update');

    Route::get('/promo_code', function () {
        return Inertia::render('Dashboard');
    })->name('promo_code');
    Route::post('/promo_code', function () {
        return Inertia::render('Dashboard');
    })->name('promo_code.store');
    Route::put('/promo_code', function () {
        return Inertia::render('Dashboard');
    })->name('promo_code.update');

    Route::get('/categories', function () {
        return Inertia::render('Dashboard');
    })->name('categories');
    Route::post('/categories', function () {
        return Inertia::render('Dashboard');
    })->name('categories.store');
    Route::put('/categories', function () {
        return Inertia::render('Dashboard');
    })->name('categories.update');

    Route::get('/games', function () {
        return Inertia::render('Dashboard');
    })->name('games');
    Route::post('/games', function () {
        return Inertia::render('Dashboard');
    })->name('games.store');
    Route::put('/games', function () {
        return Inertia::render('Dashboard');
    })->name('games.update');

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/User')->name('user.index');
    // Route::get('/User/{id}')->name('user.show');
    // Route::post('/User')->name('user.store');
    // Route::put('/User')->name('user.update');
    // Route::delete('/User')->name('user.destroy');
    
    
    // Route::get('/Subscriptions')->name('sub.index');
    // Route::get('/Subscriptions/{id}')->name('sub.show');
    // Route::post('/Subscriptions')->name('sub.store');
    // Route::put('/Subscriptions')->name('sub.update');
    // Route::delete('/Subscriptions')->name('sub.destroy');

    
    // Route::get('/Post')->name('post.index');
    // Route::get('/Post/{id}')->name('post.show');
    // Route::post('/Post')->name('post.store');
    // Route::put('/Post')->name('post.update');
    // Route::delete('/Post')->name('post.destroy');

    
    // Route::get('/Plan')->name('plan.index');
    // Route::get('/Plan/{id}')->name('plan.show');
    // Route::post('/Plan')->name('plan.store');
    // Route::put('/Plan')->name('plan.update');
    // Route::delete('/Plan')->name('plan.destroy');

    
    // Route::get('/Promo_Code')->name('promo.index');
    // Route::get('/Promo_Code/{id}')->name('promo.show');
    // Route::post('/Promo_Code')->name('promo.store');
    // Route::put('/Promo_Code')->name('promo.update');
    // Route::delete('/Promo_Code')->name('promo.destroy');

    
    // Route::get('/Categories')->name('category.index');
    // Route::get('/Categories/{id}')->name('category.show');
    // Route::post('/Categories')->name('category.store');
    // Route::put('/Categories')->name('category.update');
    // Route::delete('/Categories')->name('category.destroy');

    
    // Route::get('/Games')->name('game.index');
    // Route::get('/Games/{id}')->name('game.show');
    // Route::post('/Games')->name('game.store');
    // Route::put('/Games')->name('game.update');
    // Route::delete('/Games')->name('game.destroy');


});

require __DIR__.'/auth.php';
