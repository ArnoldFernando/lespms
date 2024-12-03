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
    public function index()
    {
        return view('home');
    }

    public function auth()
    {
        if (Auth::id()) {

            $usertype = Auth()->user()->usertype;

            if($usertype == 'admin') {
                return view ('test.admin');
            }
            else if($usertype == 'service_provider') {
                return view('test.serviceprovider');
            }
            else if($usertype == 'user') {
                return view('test.user');
            }
                else return redirect()->back();

        }

    }
}
