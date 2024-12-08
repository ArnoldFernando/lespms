<?php

use App\Http\Controllers\BlockuserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Client\ServiceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventServiceController;
use App\Http\Controllers\NotificationController;

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
    Route::get('notifications/recent', [NotificationController::class, 'getRecentNotifications'])->name('notifications.getNotifications');
    route::resource('notifications', NotificationController::class);
    Route::get('/my-services/bookings', [EventServiceController::class, 'showBookings'])->name('event-services.bookings');
    Route::post('/my-services/bookings/{bookingId}/{status}', [EventServiceController::class, 'updateStatus'])->middleware('auth')->name('event-services.updateStatus');

    Route::get('/booked-users', [BlockuserController::class, 'index'])->name('booked.users');

    // blocked users routes
    Route::post('/block-user/{user}/service', [BlockuserController::class, 'blockUserFromServices'])->name('user.block.service');
    Route::patch('/user/unblock/{userId}', [BlockuserController::class, 'unblockUser'])->name('service.user.unblock');
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


Route::get('/service-provider/notifications', [NotificationController::class, 'getNotifications'])
    ->name('service-provider.notifications');



// Route::group(['middleware' => ['auth', 'check.blocked']], function () {
//     Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
//     Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');
// });


Route::middleware('auth')->group(function () {
    Route::post('/block-user/{user}', [BlockuserController::class, 'blockUser'])->name('user.block');
    Route::post('/unblock-user/{user}', [BlockuserController::class, 'unblockUser'])->name('user.unblock');
});
