<?php

namespace App\Http\Controllers\SALES;

use App\Http\Controllers\Controller;
use App\Models\Elearning;
use Illuminate\Http\Request;

class SElearningController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $ele=Elearning::where('principle','LIKE','%'.$request->cari.'%')->get();
        }else{
        $ele = Elearning::paginate();
        }
        return view('SALES.elearning', compact('ele'));
    }
}
