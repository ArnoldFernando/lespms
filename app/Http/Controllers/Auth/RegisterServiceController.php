<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterServiceController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Single image validation
            'files.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:50000', // Each file is validated as an image
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle profile image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images'); // Adjust the path as needed
        }

        // Handle multiple file uploads
        $uploadedFiles = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $uploadedFiles[] = $file->store('public/files'); // Adjust the path as needed
            }
        }

        // Convert the uploaded file paths to JSON for storage
        $filesJson = !empty($uploadedFiles) ? json_encode($uploadedFiles) : null;

        // Create the user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'usertype' => 'service_provider',
            'image' => $imagePath,
            'files' => $filesJson,
        ]);

        // Redirect with success message
        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }
}
