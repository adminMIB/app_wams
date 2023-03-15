<?php

namespace App\Http\Controllers\SALES;

use App\Http\Controllers\Controller;
use App\Models\ElearnindDetail;
use App\Models\Elearning;
use App\Models\ListProjet;
use Illuminate\Http\Request;

class SElearningController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('cari')){
            $ele=ElearnindDetail::with('elearn')->where('principle','LIKE','%'.$request->cari.'%')->get();
        }else{
        $ele = ElearnindDetail::with('elearn')->paginate();
        }
        // $ele = ElearnindDetail::with('elearn')->paginate(10);
        // $datas = ListProjet::all()->count();
        $data = ListProjet::with('detail')->get();
        return view('SALES.elearning', compact('ele','data'));
    }
}
