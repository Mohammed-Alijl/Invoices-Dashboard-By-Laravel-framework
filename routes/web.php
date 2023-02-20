<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function(){
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
        Route::resource('sections', \App\Http\Controllers\SectionController::class);
        Route::resource('products', \App\Http\Controllers\ProductController::class);
        Route::resource('attachments', \App\Http\Controllers\AttachmentController::class);
        Route::resource('payments', \App\Http\Controllers\PaymentController::class);
        Route::resource('/profile',ProfileController::class);
        Route::get('/{page}', [\App\Http\Controllers\AdminController::class, 'index']);
        Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/section/{id}', [\App\Http\Controllers\SectionController::class, 'products']);
        Route::get('paid/invoices', [\App\Http\Controllers\InvoiceController::class, 'invoicesPaid'])->name('invoices.paid');
        Route::get('invoices/not/paid', [\App\Http\Controllers\InvoiceController::class, 'invoicesNotPaid'])->name('invoices.not.paid');
        Route::get('invoices/Partially/paid', [\App\Http\Controllers\InvoiceController::class, 'invoicesPartiallyPaid'])->name('invoices.Partially.paid');
        Route::get('deleted/invoices', [\App\Http\Controllers\InvoiceController::class, 'deletedInvoices'])->name('invoices.deleted');
        Route::get('recovery/invoices/{id}', [\App\Http\Controllers\InvoiceController::class, 'recovery'])->name('invoices.recovery');
        Route::delete('archive/invoices', [\App\Http\Controllers\InvoiceController::class, 'archive'])->name('invoices.archive');
        Route::get('print/invoices/{id}', [\App\Http\Controllers\InvoiceController::class, 'print'])->name('invoices.print');
        Route::get('reports/invoices', [\App\Http\Controllers\InvoiceReportController::class, 'index'])->name('reports.invoices');
        Route::post('search/invoices', [\App\Http\Controllers\InvoiceReportController::class, 'search'])->name('invoices.search');
        Route::get('reports/customers', [\App\Http\Controllers\CustomerReportController::class, 'index'])->name('reports.customers');
        Route::post('search/customers', [\App\Http\Controllers\CustomerReportController::class, 'search'])->name('customers.search');
        Route::get('notification/mark/all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notification.mark.all');
        Route::get('notification/display/{id}', [\App\Http\Controllers\NotificationController::class, 'display'])->name('notification.display');
        Route::get('notification/real_time/display/{id}', [\App\Http\Controllers\NotificationController::class, 'displayRealTime'])->name('notification.display.real.time');
    });
