<?php

namespace App\Http\Controllers;

use App\Models\ListProjet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();
        return view('dashboardTeknikal', compact('datas','data'));

    
    
    }
}
