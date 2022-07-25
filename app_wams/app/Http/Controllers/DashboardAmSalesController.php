<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAmSalesController extends Controller
{
    public function index()
    {
        return view('dashboardAmSales');
    }
}
