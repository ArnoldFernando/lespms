<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function redirectUserBasedOnRole()
    {
        if (Auth::id()) {

            $usertype = Auth()->user()->usertype;

            if ($usertype == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($usertype == 'service_provider') {
                return redirect()->route('service-provider.dashboard');
            } else if ($usertype == 'user') {
                return redirect()->route('client.dashboard');
            } else return redirect()->back();
        }
    }
}
