<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use Illuminate\Http\Request;

class DashboardAmSalesController extends Controller
{
    public function index()
    {
        $qq = SalesOrder::all()->count();
        return view('dashboardAmSales', compact('qq'));
    }
}
