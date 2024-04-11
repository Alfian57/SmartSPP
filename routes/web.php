<?php

use App\Http\Controllers\ClassroomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.layouts.main');
});

Route::prefix("dashboard")->as('dashboard.')->group(function () {
    Route::resource('/classrooms', ClassroomController::class)->except('show');
});
