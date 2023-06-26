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
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
Route::middleware('auth', 'admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/User')->name('user.index');
    Route::get('/User/{id}')->name('user.show');
    Route::post('/User')->name('user.store');
    Route::put('/User')->name('user.update');
    Route::delete('/User')->name('user.destroy');
    
    
    Route::get('/Subscriptions')->name('sub.index');
    Route::get('/Subscriptions/{id}')->name('sub.show');
    Route::post('/Subscriptions')->name('sub.store');
    Route::put('/Subscriptions')->name('sub.update');
    Route::delete('/Subscriptions')->name('sub.destroy');

    
    Route::get('/Post')->name('post.index');
    Route::get('/Post/{id}')->name('post.show');
    Route::post('/Post')->name('post.store');
    Route::put('/Post')->name('post.update');
    Route::delete('/Post')->name('post.destroy');

    
    Route::get('/Plan')->name('plan.index');
    Route::get('/Plan/{id}')->name('plan.show');
    Route::post('/Plan')->name('plan.store');
    Route::put('/Plan')->name('plan.update');
    Route::delete('/Plan')->name('plan.destroy');

    
    Route::get('/Promo_Code')->name('promo.index');
    Route::get('/Promo_Code/{id}')->name('promo.show');
    Route::post('/Promo_Code')->name('promo.store');
    Route::put('/Promo_Code')->name('promo.update');
    Route::delete('/Promo_Code')->name('promo.destroy');

    
    Route::get('/Categories')->name('category.index');
    Route::get('/Categories/{id}')->name('category.show');
    Route::post('/Categories')->name('category.store');
    Route::put('/Categories')->name('category.update');
    Route::delete('/Categories')->name('category.destroy');

    
    Route::get('/Games')->name('game.index');
    Route::get('/Games/{id}')->name('game.show');
    Route::post('/Games')->name('game.store');
    Route::put('/Games')->name('game.update');
    Route::delete('/Games')->name('game.destroy');


});

require __DIR__.'/auth.php';
