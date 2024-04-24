<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use App\Models\Invoice;
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
    
    //customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.main');
    Route::post('/customers/filterResult', [CustomerController::class, 'filterResult'])->name('customers.filterResult');
    Route::get('/customers/filters={type}&{email}&{name}&{city}&{address}&{postalCodeMax}&{postalCodeMin}', [CustomerController::class,'filterApplied'])->name('customers.filterApplied');
    Route::get('/customers/{page}', [CustomerController::class, 'page'])->name('customers.page');
    
    //invoices
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.main');
    Route::post('/invoices/create', [InvoiceController::class, 'storeInvoice'])->name('invoices.storeInvoice');
    Route::get('/invoices/create', [InvoiceController::class, 'createInvoice'])->name('invoices.createInvoice');
    Route::post('/invoices/{invoice}', [InvoiceController::class, 'updateInvoice'])->name('invoices.updateInvoice');
    Route::post('/invoices/filterResult', [InvoiceController::class, 'filterResult'])->name('invoices.filterResult');
    Route::get('/invoices/edit/{invoice}', [InvoiceController::class, 'editInvoice'])->name('invoices.editInvoice');
    Route::get('/invoices/filters={id}&{customerId}&{status}&{billedDate}&{paidDate}&{amountMin}&{amountMax}', [InvoiceController::class,'filterApplied'])->name('invoices.filterApplied');
    Route::get('/invoices/{page}', [InvoiceController::class, 'page'])->name('invoices.page');
    
    

});

require __DIR__.'/auth.php';
