<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.client-layout', function ($view) {
            $authUserId = auth()->id();

            if (!$authUserId) {
                $view->with('chatUsers', collect());
                return;
            }

            // Fetch the user IDs of the people the user has chatted with, excluding the current user
            $userIds = Message::where('sender_id', $authUserId)
                ->orWhere('receiver_id', $authUserId)
                ->get()
                ->map(function ($message) use ($authUserId) {
                    return $message->sender_id === $authUserId ? $message->receiver_id : $message->sender_id;
                })
                ->unique();

            // Exclude the current user's profile from the list of chat users
            $chatUsers = User::whereIn('id', $userIds)
                ->where('id', '!=', $authUserId) // Exclude the authenticated user
                ->with(['messages' => function ($query) use ($authUserId) {
                    $query->where('sender_id', $authUserId)
                        ->orWhere('receiver_id', $authUserId)
                        ->latest();
                }])
                ->get();

            $view->with('chatUsers', $chatUsers);
        });



        View::composer('layouts.serv-provider-layout', function ($view) {
            $authUserId = auth()->id();

            if (!$authUserId) {
                $view->with('chatUsers', collect());
                return;
            }

            // Fetch the user IDs of the people the user has chatted with, excluding the current user
            $userIds = Message::where('sender_id', $authUserId)
                ->orWhere('receiver_id', $authUserId)
                ->get()
                ->map(function ($message) use ($authUserId) {
                    return $message->sender_id === $authUserId ? $message->receiver_id : $message->sender_id;
                })
                ->unique();

            // Exclude the current user's profile from the list of chat users
            $chatUsers = User::whereIn('id', $userIds)
                ->where('id', '!=', $authUserId) // Exclude the authenticated user
                ->with(['messages' => function ($query) use ($authUserId) {
                    $query->where('sender_id', $authUserId)
                        ->orWhere('receiver_id', $authUserId)
                        ->latest();
                }])
                ->get();

            $view->with('chatUsers', $chatUsers);
        });
    }
}
