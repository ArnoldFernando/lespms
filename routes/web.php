<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'auth'])->name('home');


// Admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    route::view('admin', 'Admin.dashboard');
});



// service provider routes
Route::middleware(['auth', 'service_provider'])->group(function () {
    route::view('services', 'Service.dashboard');
    route::resource('services', EventServiceController::class);
});



// user routes
Route::middleware(['auth', 'user'])->group(function () {
    route::view('user', 'Client.dashboard');
});
