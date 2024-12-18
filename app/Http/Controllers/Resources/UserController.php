<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
