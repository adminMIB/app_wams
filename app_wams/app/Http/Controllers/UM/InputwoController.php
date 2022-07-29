<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\ListProjectPm;
use App\Models\SalesOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class InputwoController extends Controller
{
    public function index()
    {
        $data = SalesOrder::all();
        $datas = SalesOrder::all()->count();
        $detailId =  SalesOrder::all();


        return view('UM.indexInputWorkOder', compact('data', 'datas'));
    }

    public function show($id)
    {
        $detailId = SalesOrder::find($id);
        $datas = SalesOrder::all()->count();
        $user = Role::with('users')->where("name", "PM Lead")->get();

        return view('UM.inputwo', compact('detailId', 'datas', 'user'));
    }

    public function  store(Request $request)
    {   

        $validator = Validator::make($request->all(),[
            'sign_pm_lead' => 'required',
        ]);    
        
        if($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validator->errors()
            ], 442);
        }



        try {
        // kita buat role nya
         ListProjectPm::create([
        "no_sales" => $request->no_sales,
        "tgl_sales" => $request->tgl_sales,
        "nama_sales" => $request->nama_sales,
        "nama_institusi" => $request->nama_institusi,
        "nama_project" => $request->nama_project,
        "hps" => $request->hps,
        "sign_pm_lead" => $request->sign_pm_lead,
        ]);
        // lalu kasih permision berdasarakn user select

        return redirect('/approval');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
