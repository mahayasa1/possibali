<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/news', function () {
    return view('news.index');
});

Route::get('/events', function () {
    return view('events.index');
});

Route::get('/satgas', function () {
    return view('satgas.index');
});

Route::get('/clubs', function () {
    return view('clubs.index');
});

Route::get('/contact', function () {
    return view('contact');
});

