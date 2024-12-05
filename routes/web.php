<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\Client\ServiceController;
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
    Route::get('/my-services/bookings', [EventServiceController::class, 'showBookings'])->name('event-services.bookings');
    Route::post('/my-services/bookings/{bookingId}/{status}', [EventServiceController::class, 'updateStatus'])->middleware('auth')->name('event-services.updateStatus');
});



// user routes
Route::middleware(['auth', 'user'])->group(function () {
    // TESTING
    route::view('user', 'Client.dashboard');

    // real user routes

    Route::prefix('client')->name('client.')->group(function () {
        route::resource('service', ServiceController::class);
        route::get('servicedetails/{id}', [ServiceController::class, 'view_details'])->name('view-details');
        route::resource('bookings', BookingController::class);
    });
});
