<?php

namespace App\Http\Controllers\viewControlerrSuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Elearning;
use App\Models\SalesOpty;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesControllerM extends Controller
{
    public function index()
    {
        
        $sales= SalesOpty::all();
        return view('superAdmin.salesMonitoring.dashboardSalesOpty', compact('sales'));
    }
    

    public function create()
    {
        $ele= Elearning::all();
        return view('superAdmin.salesMonitoring.addSalesOpty', compact('ele') ); //, compact('kd')   
    }


    public function store(Request $request)
    {
      
            $request->validate([
            "NamaClient" => "required|string",
            "NamaProject" => "required|string",
            "Timeline" => "required|string",
            "Date" => "required|string",
            "Angka" => "required|integer",
            "Status" => "required|string",
            "Note" => "required|string",
            "elearning_id" => "required"

            ],[

            'NamaClient.required'=> 'Nama Client tidak boleh kosong!',
            'NamaProject.required'=> 'Nama Project tidak boleh kosong!',
            'Timeline.required'=>'Timeline tidak boleh kosong!',
            'Date.required'=>'Date tidak boleh kosong!',
            'Angka.required'=> 'Angka tidak boleh kosong',
            'Status.required'=>'Status tidak boleh kosong!',
            'Note.required'=>'Note tidak boleh kosong!',
            'elearning_id.required'=> 'Solusi/Produk tidak boleh kosong'


           ]);

            SalesOpty::create([
                "NamaClient" => $request->NamaClient,
                "NamaProject" => $request->NamaProject,
                "Timeline" => $request->Timeline,
                "Date" => $request->Date,
                "Angka" => $request->Angka,
                "Status" => $request->Status,
                "Note" => $request->Note,
                "elearning_id" => $request->elearning_id
            ]);

            return redirect('/dashboard/salesOpty');

     
    }

    public function filter(Request $request)
    {
        try {
            if ($request->timeline == 'Q1') {
                $sales =  SalesOpty::whereBetween('date', [Carbon::now()->month(01)->startOfMonth(), Carbon::now()->month(03)->endOfMonth()])->orderBy('created_at', 'desc')->paginate(10);
            } elseif ($request->timeline == 'Q2') {
                $sales =  SalesOpty::whereBetween('date', [Carbon::now()->month(04)->startOfMonth(), Carbon::now()->month(06)->endOfMonth()])->orderBy('created_at', 'desc')->paginate(10);
            } elseif ($request->timeline == 'Q3') {
                $sales =  SalesOpty::whereBetween('date', [Carbon::now()->month(07)->startOfMonth(), Carbon::now()->month('09')->endOfMonth()])->orderBy('created_at', 'desc')->paginate(10);
            } elseif ($request->timeline == 'Q4') {
                $sales =  SalesOpty::whereBetween('date', [Carbon::now()->month(10)->startOfMonth(), Carbon::now()->month(12)->endOfMonth()])->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $sales =  SalesOpty::orderBy('created_at', 'desc')->paginate(10);
            }

            return view('salesopty.index', compact('sales'));
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => "Gagal"
            ]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = SalesOpty::with('elearnings')->find($id);
        return view('salesopty.detail', compact('detail'));
    }

    public function destroy($id)
    {
        $deletData = SalesOpty::find($id);
        $deletData->delete();
        $sales= SalesOpty::all();
        return view('superAdmin.salesMonitoring.dashboardSalesOpty', compact('sales'));

    }

}
