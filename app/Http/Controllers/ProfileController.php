<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getClientProfile()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('client.profile.index', compact('user'));
    }

    public function editClientProfile()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('client.profile.edit', compact('user'));
    }

    public function getServiceProviderProfile()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('service.profile.index', compact('user'));
    }

    public function editServiceProviderProfile()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('service.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . Auth::id(),
            'old_password' => 'required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed', // Ensures new password matches the confirmation
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ], [
            'old_password.current_password' => 'The old password is incorrect.',
            'new_password.confirmed' => 'The new password and confirmation password do not match.',
        ]);

        $user = Auth::user();

        // Update the name and email
        $user->name = $request->input('name');

        // Update password if new password is provided
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->input('new_password'));
        }

        // Handle the image upload if provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
        }

        // dd($user);

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function deleteProfile()
    {
        $user = Auth::user();
        $user->delete();
        return redirect()->route('login')->with('success', 'Profile deleted');
    }
}
