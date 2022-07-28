<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coba;
use Illuminate\Support\Facades\DB;

class CobaController extends Controller
{
    public function index()
    {
        return view('task');
    }

    public function store(Request $request)
    {


        if (!empty($request->input('isian'))) {
            $will_insert = [];
            foreach ($request->input('isian') as $key => $value) {
                array_push($will_insert, ['isian' => $value]);
            }
            DB::table('cobas')->insert($will_insert);
            //$chekbox = join(',', $request->input('isian'));
            //DB::table('cobas')->insert(['isian' => $chekbox]);

            
        } else {
            $chekbox = '';
          
        }
        return redirect('task');
    
    }
}
