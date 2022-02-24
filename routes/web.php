<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['isNotLoggedIn'])->group(function(){
    Route::get('/login', [AdminController::class,'showLoginForm']);
    Route::post('/login', [AdminController::class,'validateLogin'])->name('login');
});

Route::middleware(['isAdmin'])->group(function(){
    Route::get('/dashboard',[AdminController::class,'showAdminDashboard']);
    Route::get('/dashboard/customers/add',[AdminController::class,'showAdminCustomerForm']);
    Route::post('/dashboard/customers/add',[AdminController::class,'createCustomer'])->name('admin-create-customer');
    Route::get('/dashboard/customers/edit/{id}',[AdminController::class,'showAdminCustomerEditForm']);
    Route::put('/dashboard/customers/edit/{id}',[AdminController::class,'updateCustomer'])->name('admin-update-customer');
    Route::delete('/dashboard/customers/delete/{id}',[AdminController::class,'removeCustomer']);
    Route::post('/dashboard/logout',[AdminController::class,'logoutAdmin']);
});