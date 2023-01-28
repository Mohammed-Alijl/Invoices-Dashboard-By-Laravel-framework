<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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



Route::middleware('auth')->group(function () {
    Route::resource('invoices',\App\Http\Controllers\InvoiceController::class);
    Route::resource('sections',\App\Http\Controllers\SectionController::class);
    Route::resource('products',\App\Http\Controllers\ProductController::class);
    Route::get('/{page}', [\App\Http\Controllers\AdminController::class,'index']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {return view('dashboard');})->name('dashboard');
});


