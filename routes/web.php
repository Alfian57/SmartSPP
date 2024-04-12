<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentParentController;
use Illuminate\Support\Facades\Route;

Route::prefix("dashboard")->as('dashboard.')->group(function () {
    Route::get("/", [DashboardController::class, 'index'])->name('index');

    Route::resource('/admins', AdminController::class)->except('show');
    Route::resource('/classrooms', ClassroomController::class)->except('show');
    Route::resource('/student-parents', StudentParentController::class)->except('show');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments/{payment}/reject', [PaymentController::class, 'reject'])->name('payments.reject');
    Route::post('/payments/{payment}/accept', [PaymentController::class, 'accept'])->name('payments.accept');

    Route::resource('/students', StudentController::class)->except('show');
    Route::get('/students/{student}/bills', [BillController::class, 'index'])->name('students.bills.index');
});