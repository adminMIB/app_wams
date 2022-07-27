<?php

namespace App\Http\Controllers\SALES;

use App\Exports\SalesOptyExport;
use App\Http\Controllers\Controller;
use App\Models\Elearning;
use Carbon\Carbon;
use App\Models\SalesOpty;
use Illuminate\Http\Request;

class SalesOptyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $sales = SalesOpty::all();
      if($request->has('cari')) {
        $sales=SalesOpty::where('Date', 'LIKE', '%'.$request->cari. '%')->get();
      }else{
        $sales = SalesOpty::paginate(5);
    }
        return view('SALES.index', compact('sales'));
    }

    //public function salesoptyexport(){
        //return Excel::download(new SalesOptyExport, 'salesopty.xlsx'());
    //}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ele = Elearning::all();
        
        return view('SALES.inputsales',compact('ele'));
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

            return redirect('index-sales');

     
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

            return view('SALES.index', compact('sales'));
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
        return view('SALES.detail', compact('detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ele = Elearning::all();
         $edit = SalesOpty::find($id);
         return view('SALES.edit', compact('edit','ele'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sales = SalesOpty::find($id);

        $sales->update([
            "NamaClient" => $request->NamaClient,
            "NamaProject" => $request->NamaProject,
            "Timeline" => $request->Timeline,
            "Date" => $request->Date,
            "Angka" => $request->Angka,
            "Status" => $request->Status,
            "Note" => $request->Note,
            "elearning_id" => $request->elearning_id
        ]);

        return redirect('index-sales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sales = SalesOpty::find($id);
        $sales -> delete();
        return back();
    }

    public function export() 
    {
        // return Excel::download(new SalesOptyExport, 'salesopty.xlsx');
    }

    public function cetak()
    {
        $sales = SalesOpty::all();
        return view('SALES.cetak', compact('sales'));
    }


}
