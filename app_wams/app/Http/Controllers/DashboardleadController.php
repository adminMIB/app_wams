<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardleadController extends Controller
{
    public function index()
    {
        return view('dashboardlead');
    }
}
