<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentParentController;
use Illuminate\Support\Facades\Route;

Route::prefix("dashboard")->as('dashboard.')->group(function () {
    Route::get("/", [DashboardController::class, 'index'])->name('index');

    Route::resource('/admins', AdminController::class)->except('show');
    Route::resource('/classrooms', ClassroomController::class)->except('show');
    Route::resource('/student-parents', StudentParentController::class)->except('show');
    Route::resource('/students', StudentController::class)->except('show');
    Route::resource('/students/{student}/bills', BillController::class)->except('');
});
