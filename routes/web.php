<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
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
require __DIR__ . '/auth.php';


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {
    Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'invoices' => InvoiceController::class,
        'sections' => SectionController::class,
        'products' => ProductController::class,
        'attachments' => AttachmentController::class,
        'payments' => PaymentController::class,
        'profile' => ProfileController::class,
    ]);
    Route::group(['postfix' => 'invoices'], function () {
        Route::get('paid', [\App\Http\Controllers\InvoiceController::class, 'invoicesPaid'])->name('invoices.paid');
        Route::get('unpaid', [\App\Http\Controllers\InvoiceController::class, 'invoicesNotPaid'])->name('invoices.not.paid');
        Route::get('Partially/paid', [\App\Http\Controllers\InvoiceController::class, 'invoicesPartiallyPaid'])->name('invoices.Partially.paid');
        Route::get('archived', [\App\Http\Controllers\InvoiceController::class, 'deletedInvoices'])->name('invoices.deleted');
        Route::get('recovery/{id}', [\App\Http\Controllers\InvoiceController::class, 'recovery'])->name('invoices.recovery');
        Route::delete('archive/invoices', [\App\Http\Controllers\InvoiceController::class, 'archive'])->name('invoices.archive');
        Route::get('print/{id}', [\App\Http\Controllers\InvoiceController::class, 'print'])->name('invoices.print');
        Route::get('reports', [\App\Http\Controllers\InvoiceReportController::class, 'index'])->name('reports.invoices');
        Route::post('search', [\App\Http\Controllers\InvoiceReportController::class, 'search'])->name('invoices.search');
    });

    Route::group(['prefix' => 'notification'], function () {
        Route::get('mark/all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notification.mark.all');
        Route::get('display/{id}', [\App\Http\Controllers\NotificationController::class, 'display'])->name('notification.display');
        Route::get('real_time/display/{id}', [\App\Http\Controllers\NotificationController::class, 'displayRealTime'])->name('notification.display.real.time');
    });

    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/section/{id}', [\App\Http\Controllers\SectionController::class, 'products']);
    Route::get('reports/customers', [\App\Http\Controllers\CustomerReportController::class, 'index'])->name('reports.customers');
    Route::post('search/customers', [\App\Http\Controllers\CustomerReportController::class, 'search'])->name('customers.search');

});
