<?php

namespace App\Http\Controllers;

use App\Models\ListProjet;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::with('detail')->get();
        return view('dashboardTeknikal', compact('datas','data'));

    
    
    }
}
