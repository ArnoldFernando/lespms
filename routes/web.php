<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resources\UserController;
use App\Http\Controllers\Resources\ServiceController;
use App\Http\Controllers\Resources\EventServiceController;
use App\Http\Controllers\Resources\BookingController;
use App\Http\Controllers\Resources\NotificationController;
use App\Http\Controllers\Resources\BlockuserController;
use App\Http\Controllers\ServiceProvider\DashboardController as ServiceProviderDashboardController;
use App\Mail\notifmail;
use App\Livewire\Chat;

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

Route::get('/home', [HomeController::class, 'redirectUserBasedOnRole'])
    ->middleware('auth')
    ->name('home');


Route::middleware('auth')->group(function () {
    // client
    Route::get('/client/profile', [ProfileController::class, 'userprofile'])->name('user.profile');
    Route::get('/clientprofile/edit', [ProfileController::class, 'editProfile'])->name('user.edit');
    // service provider
    Route::get('/service-provider/profile', [ProfileController::class, 'serviceprofile'])->name('service.profile');
    Route::get('/service-provider/profile/edit', [ProfileController::class, 'editserviceProfile'])->name('service.profile.edit');

    Route::put('profile/update', [ProfileController::class, 'updateProfile'])->name('user.update');
});

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'getData'])
            ->name('admin.dashboard');
        Route::put('users/{id}/usertype', [UserController::class, 'updateUsertype'])
            ->name('users.updateUsertype');
        Route::resource('users', UserController::class);
    });

Route::prefix('service-provider')
    ->middleware(['auth', 'service.provider'])
    ->group(function () {
        Route::get('dashboard', [ServiceProviderDashboardController::class, 'index'])
            ->name('service-provider.dashboard');
        Route::resource('services', EventServiceController::class);
        Route::get('notifications/recent', [NotificationController::class, 'getRecentNotifications'])
            ->name('notifications.getNotifications');
        Route::resource('notifications', NotificationController::class);
        Route::get('/my-services/bookings', [EventServiceController::class, 'showBookings'])
            ->name('event-services.bookings');
        Route::post('/my-services/bookings/{bookingId}/{status}', [EventServiceController::class, 'updateStatus'])
            ->name('event-services.updateStatus');
        Route::get('/booked-users', [BlockuserController::class, 'index'])
            ->name('booked.users');
        Route::post('/block-user/{user}/service', [BlockuserController::class, 'blockUserFromServices'])
            ->name('user.block.service');
        Route::patch('/user/unblock/{userId}', [BlockuserController::class, 'unblockUser'])
            ->name('service.user.unblock');
    });


// TODO: refactor the routes below
// user routes
Route::middleware(['auth', 'user'])->group(function () {
    route::view('user', 'Client.dashboard');
    Route::prefix('client')->name('client.')->group(function () {
        route::resource('service', ServiceController::class);
        route::get('servicedetails/{id}', [ServiceController::class, 'view_details'])
            ->name('view-details');
        route::resource('bookings', BookingController::class);
        Route::get('notifications/{id}', [NotificationController::class, 'showuser'])->name('notifications.show');
    });
});


Route::get('/service-provider/notifications', [NotificationController::class, 'getNotifications'])
    ->name('service-provider.notifications');

Route::middleware('auth')->group(function () {
    Route::post('/block-user/{user}', [BlockuserController::class, 'blockUser'])->name('user.block');
    Route::post('/unblock-user/{user}', [BlockuserController::class, 'unblockUser'])->name('user.unblock');
});
Route::get('/chat/{receiverId}', Chat::class)->name('chat');


// Route::get('/testmail', function () {
//     Mail::to('junfernando728@gmail.com')->send(new notifmail(''));
// });
