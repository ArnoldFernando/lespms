<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\RegisterServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Resources\UserController;
use App\Http\Controllers\Resources\ServiceController;
use App\Http\Controllers\Resources\EventServiceController;
use App\Http\Controllers\Resources\BookingController;
use App\Http\Controllers\Resources\NotificationController;
use App\Http\Controllers\ServiceProvider\BlockuserController;
use App\Http\Controllers\ServiceProvider\DashboardController as ServiceProviderDashboardController;
use App\Http\Controllers\Client\DashboardController as ClientDashboardController;

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

Route::get('/home', [HomeController::class, 'redirectUserBasedOnRole'])->middleware('auth')->name('home');


// register routes
Route::view('register-service-provider', 'Auth.register-service')->name('register-service');
Route::post('/register-service-as-provider', [RegisterServiceController::class, 'store'])->name('register-service-as-provider');

// admin routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('dashboard', [AdminDashboardController::class, 'getData'])
            ->name('dashboard');
        Route::patch('users/verify/{user}', [UserController::class, 'verify'])->name('users.verify');
        Route::resource('users', UserController::class);
    });

// service provider routes

Route::prefix('service-provider')
    ->name('service-provider.')
    ->middleware(['auth', 'service.provider'])
    ->group(function () {
        Route::get('dashboard', [ServiceProviderDashboardController::class, 'index'])->name('dashboard');
        Route::resource('services', EventServiceController::class)->middleware('verified.provider');
        Route::get('notifications/recent', [NotificationController::class, 'getRecentNotifications'])->name('notifications.getNotifications');
        Route::resource('notifications', NotificationController::class);
        Route::resource('bookings', BookingController::class);
        Route::get('/booked-users', [BlockuserController::class, 'index'])->name('booked.users');
        Route::post('/block-user/{user}/service', [BlockuserController::class, 'blockUserFromServices'])->name('user.block.service');
        Route::post('/user/unblock/{userId}', [BlockuserController::class, 'unblockUser'])->name('user.unblock');
        Route::get('profile', [ProfileController::class, 'getServiceProviderProfile'])->name('profile');
        Route::get('profile/edit', [ProfileController::class, 'editServiceProviderProfile'])->name('profile.edit');
        Route::put('profile/update', [ProfileController::class, 'updateProfile'])->name('update');
        Route::post('/block-user/{user}', [BlockuserController::class, 'blockUser'])->name('user.block');
        Route::post('/unblock-user/{user}', [BlockuserController::class, 'unblockUser'])->name('user.unblock');
        Route::get('/chat/{receiverId}', Chat::class)->name('chat');
        Route::get('verification/notice', function () {
            return view('Service.verification.notice');
        })->name('verification.notice');
    });

// client routes

Route::prefix('client')
    ->name('client.')
    ->middleware(['auth', 'client'])
    ->group(function () {
        Route::get('dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
        Route::resource('service', ServiceController::class);
        Route::resource('bookings', BookingController::class);
        Route::get('notifications/{id}', [NotificationController::class, 'showuser'])->name('notifications.show');
        Route::get('profile', [ProfileController::class, 'getClientProfile'])->name('profile');
        Route::get('profile/edit', [ProfileController::class, 'editClientProfile'])->name('profile.edit');
        Route::put('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::get('/chat/{receiverId}', Chat::class)->name('chat');
    });


// Route::get('/testmail', function () {
//     Mail::to('junfernando728@gmail.com')->send(new notifmail(''));
// });
