<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        // if (!$user) {
        //     return redirect()->route('users.index')->with('error', 'User not found');
        // }

        return view('admin.users.show', compact('user'));
    }

    public function verify(Request $request, User $user)
    {
        $request->validate([
            'admin_password' => 'required|string',
        ]);

        if (!Hash::check($request->admin_password, Auth::user()->password)) {
            return redirect()->back()->withErrors(['admin_password' => 'The password you entered is incorrect.']);
        }

        $user->verified = true; 
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User has been successfully verified.');
    }
}
