<?php

namespace App\Http\Controllers;

use App\Models\SalesOpty;
use Illuminate\Http\Request;

class LpadminPmLeadController extends Controller
{
    public function index(Request $request)
    {
    $sales = SalesOpty::all();
        if($request->has('cari')) {
            $sales=SalesOpty::where('Date', 'LIKE', '%'.$request->cari. '%')->get();
        }else{
            $sales = SalesOpty::paginate(5);
    }
        return view('lpadminpmlead', compact('sales'));
    }
}
