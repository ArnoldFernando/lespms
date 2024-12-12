<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function auth()
    {
        if (Auth::id()) {

            $usertype = Auth()->user()->usertype;

            if ($usertype == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($usertype == 'service_provider') {
                return redirect()->route('service-provider.dashboard');
            } else if ($usertype == 'user') {
                //TODO: make this a redirect to the client dashboard
                // return redirect()->route('client.dashboard');
                return view('Client.dashboard');
            } else return redirect()->back();
        }
    }
}
