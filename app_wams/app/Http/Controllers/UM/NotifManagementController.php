<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class NotifManagementController extends Controller
{
    public function index()
    {
            // $datas = SalesOrder::all();
            // return view('partials.navbarManagement', compact('datas'));
    }

    // public function show($id)
    // {
    //     $detailId = SalesOrder::find($id);

    //     return view('UM.detailapproval', compact('detailId'));
    // }
    
}
