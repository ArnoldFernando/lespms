<?php

namespace App\Http\Controllers;

use App\Models\EventService;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //

    public function welcome()
    {
        $services = EventService::all(); // Fetch all services
        return view('welcome', compact('services'));
    }
}
