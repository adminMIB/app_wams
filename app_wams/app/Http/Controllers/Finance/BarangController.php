<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = DB::table('barangs')->select(DB::raw('MAX(RIGHT(kode_barang,3)) as kode'));
        $dd = "";
        if ($q->count() > 0)
        {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $dd = sprintf("%03s", $tmp);
            }
        }   else
        {
            $dd = "001";
        }

        $brg = Barang::all();
        return view('finance.Barang.index',compact('dd','brg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brg = new Barang;
        $brg->kode_barang=$request->kode_barang;
        $brg->nama_barang=$request->nama_barang;
        $brg->jenis_barang=$request->jenis_barang;
        $brg->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brg = Barang::find($id);
        $b = Barang::all();
        return view('finance.Barang.edit',compact('brg','b'));
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
        $brg = Barang::find($id);

        $brg->update([
            'nama_barang'=>$request->nama_barang,
            'jenis_barang'=>$request->jenis_barang,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brg = Barang::find($id);
        $brg->delete();
        return redirect()->back();
    }
}
