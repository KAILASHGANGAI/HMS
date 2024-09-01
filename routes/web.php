<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerExpenseController;
use App\Http\Controllers\DepositeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Models\CustomerExpense;
use Illuminate\Support\Facades\Route;

Route::get('login', function () {
    return view('auth.login');
})->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//middle ware
Route::middleware('auth')->group(function () {
    Route::get('/',[AdminController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class);
    Route::get('customers-update/{id}', [CustomerController::class, 'sideUpdate'])->name('customers.sideupdate');
    Route::get('customers-expenses/{id}', [CustomerController::class, 'expenses'])->name('customers.expenses');
    Route::put('customers-update/{id}', [CustomerController::class, 'cupdate'])->name('cupdate');
    Route::get('customers-running', [CustomerController::class, 'runnungCustomer'])->name('runnungCustomer');
    Route::resource('expenses', ExpenseController::class);
    Route::resource('deposits', DepositeController::class);
    Route::resource('customer-expenses', CustomerExpenseController::class);
    Route::resource('contractors', ContractorController::class);

});


