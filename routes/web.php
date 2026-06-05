<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\SatgasController;

// ── Public Routes ──────────────────────────────────────────────
Route::get('/', fn() => view('home'));
Route::get('/news', fn() => view('news.index'));
Route::get('/events', fn() => view('events.index'));
Route::get('/satgas', fn() => view('satgas.index'));
Route::get('/clubs', fn() => view('clubs.index'));
Route::get('/contact', fn() => view('contact'));

// ── Auth Routes ────────────────────────────────────────────────
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ── Admin Routes ───────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // News CRUD
    Route::resource('news', NewsController::class);
    Route::post('news/{news}/toggle-publish', [NewsController::class, 'togglePublish'])
        ->name('news.toggle-publish');

    // Events CRUD
    Route::resource('events', EventController::class);

    // Clubs CRUD
    Route::resource('clubs', ClubController::class);

    // Satgas CRUD
    Route::resource('satgas', SatgasController::class);

});