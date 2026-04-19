<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SavingController;
use App\Http\Controllers\RepaymentController;

// Home
Route::get('/', function () {
    return view('home');
});

// Auth
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔴 Public Contact Route (no auth)
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// 🔒 Protected Routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Incomes
    Route::resource('incomes', IncomeController::class);
    Route::get('/incomes/{income}/print', [IncomeController::class, 'print'])
        ->name('incomes.print');

    // Deposits
    Route::resource('deposits', DepositController::class);
    Route::get('/deposits/{deposit}/print', [DepositController::class, 'print'])
        ->name('deposits.print');

    // Withdrawals
    Route::resource('withdraws', WithdrawalController::class);
    Route::get('/withdraws/{withdraw}/print', [WithdrawalController::class, 'print'])
        ->name('withdraws.print');

    // Loans
    Route::resource('loans', LoanController::class);
    Route::get('/loans/{loan}/print', [LoanController::class, 'print'])
        ->name('loans.print');
    //reports
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportsController::class, 'index'])->name('reports.index');
        Route::post('/generate', [ReportsController::class, 'generate'])->name('reports.generate');

        Route::post('/reports/export-pdf', [ReportsController::class, 'exportPdf'])->name('reports.export.pdf');
        Route::post('/reports/export-excel', [ReportsController::class, 'exportExcel'])->name('reports.export.excel');
    });

    // Savings
    Route::resource('savings', SavingController::class);

    // Custom route for receipt (like incomes.print)
    Route::get('/savings/{saving}/receipt', [SavingController::class, 'receipt'])
        ->name('savings.receipt');

    // Repayments resource routes
    Route::resource('repayments', RepaymentController::class);

    // Custom route for repayment receipt
    Route::get('/repayments/{repayment}/receipt', [RepaymentController::class, 'receipt'])
        ->name('repayments.receipt');
});
