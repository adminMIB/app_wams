<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class UmDashboardController extends Controller
{
    public function index()
    { 
        $datas = SalesOrder::all()->count();
        // foreach ($datas as $key => $value) {
        //     return $value ;
        // }
        return view('UM.dashboard', compact('datas'));
    }
}
