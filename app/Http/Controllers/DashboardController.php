<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get countries
        $countries = Country::all();

        return view('dashboard', compact('countries'));
    }
}
