<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPmController extends Controller
{
    public function index()
    {
        return view('dashboardpm');
    }
}
