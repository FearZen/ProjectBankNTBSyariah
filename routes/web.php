<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessFormController;

Route::get('/', function () {
    return view('create');
});

Route::resource('access_forms', AccessFormController::class);
