<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.main');
    Route::post('/customers/filterResult', [CustomerController::class, 'filterResult'])->name('customers.filterResult');
    Route::get('/customers/filters={type}&{email}&{name}&{city}&{address}&{postalCodeMax}&{postalCodeMin}', [CustomerController::class,'filterApplied'])->name('customers.filterApplied');
    Route::get('/customers/{page}', [CustomerController::class, 'page'])->name('customers.page');
});

require __DIR__.'/auth.php';
