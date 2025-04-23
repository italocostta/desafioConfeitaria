<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConfeitariaController;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::resource('confeitarias', ConfeitariaController::class);