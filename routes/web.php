<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::resource('confeitarias', ConfeitariaController::class);