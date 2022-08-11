<?php

namespace App\Http\Controllers;

use App\Models\ListToPm;
use Illuminate\Http\Request;

class DashboardPmController extends Controller
{
    public function index()
    {
        $datas = ListToPm::all()->count();
        $data = ListToPm::all();
        return view('dashboardpm',compact('datas','data'));
    }

}
