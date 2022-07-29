<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class InputwoController extends Controller
{
    public function index()
    {
        $data = SalesOrder::all();
        $datas = SalesOrder::all()->count();

      

        return view('UM.inputwo', compact('data', 'datas'));
    }
}
