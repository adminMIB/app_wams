<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UmDashboardController extends Controller
{
    public function index()
    {
        return view('UM/dashboard');
    }
}
