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

Route::group(['prefix' => 'login','middleware' => ['isNotLoggedIn']],function(){
    Route::get('/', [AdminController::class,'showLoginForm']);
    Route::post('/', [AdminController::class,'validateLogin'])->name('login');
});

Route::group(['prefix' => 'dashboard','middleware' => ['isAdmin']],function(){
    Route::get('/',[AdminController::class,'showAdminDashboard']);
    Route::get('/customers/add',[AdminController::class,'showAdminCustomerForm']);
    Route::post('/customers/add',[AdminController::class,'createCustomer'])->name('admin-create-customer');
    Route::get('/customers/edit/{id}',[AdminController::class,'showAdminCustomerEditForm']);
    Route::put('/customers/edit/{id}',[AdminController::class,'updateCustomer'])->name('admin-update-customer');
    Route::delete('/customers/delete/{id}',[AdminController::class,'removeCustomer']);
    Route::post('/logout',[AdminController::class,'logoutAdmin']);
});