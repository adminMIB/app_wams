<?php

namespace App\Http\Controllers\SALES;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $qq = SalesOrder::all()->count();
        return view('SALES.dashboard', compact('qq'));
    }
}
