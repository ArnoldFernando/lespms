<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
            //TODO: make the dashboard view better

        return view('Client.dashboard');
    }
}
