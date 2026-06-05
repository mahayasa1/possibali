<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\SatgasController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (PAKAI CONTROLLER)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// NEWS
Route::get('/news', [NewsController::class, 'publicIndex'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// EVENTS
Route::get('/events', [EventController::class, 'publicIndex'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// CLUBS
Route::get('/clubs', [ClubController::class, 'publicIndex'])->name('clubs.index');
Route::get('/clubs/{club}', [ClubController::class, 'show'])->name('clubs.show');

// SATGAS
Route::get('/satgas', [SatgasController::class, 'publicIndex'])->name('satgas.index');
Route::get('/satgas/{satgas}', [SatgasController::class, 'show'])->name('satgas.show');

// CONTACT
Route::get('/contact', fn() => view('contact'));


/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // NEWS
        Route::resource('news', NewsController::class);
        Route::post('news/{news}/toggle-publish', [NewsController::class, 'togglePublish'])
            ->name('news.toggle-publish');

        // EVENTS
        Route::resource('events', EventController::class);

        // CLUBS
        Route::resource('clubs', ClubController::class);

        // SATGAS
        Route::resource('satgas', SatgasController::class);
    });