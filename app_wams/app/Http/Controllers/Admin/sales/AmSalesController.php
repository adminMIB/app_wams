<?php

namespace App\Http\Controllers\Admin\sales;

use App\Http\Controllers\Controller;
use App\Models\Elearning;
use App\Models\SalesOpty;
use Illuminate\Http\Request;

class AmSalesController extends Controller
{
    public function index(Request $request)
    {
    $sales = SalesOpty::all();
        if($request->has('cari')) {
            $sales=SalesOpty::where('Date', 'LIKE', '%'.$request->cari. '%')->get();
        }else{
            $sales = SalesOpty::paginate(5);
    }
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $ele = Elearning::all();
        
        return view('SALES.inputsales',compact('ele'));
    }
}
