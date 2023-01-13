<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class ProjectAllController extends Controller
{

    public function index()
    {
        $data = SalesOrder::all();
        return view('UM.index-project',compact('data'));
    }

    public function showP($id)
    {
        $shorder = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies','bast.so')->find($id);
        return view('UM.showP',compact('shorder'));
    }
}
