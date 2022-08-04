<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class ListdController extends Controller
{
    public function index()
    {
        $datas = SalesOrder::all()->count();

        return view('UM.listd', compact('datas'));
    }
}
