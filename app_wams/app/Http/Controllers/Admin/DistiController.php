<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use Illuminate\Http\Request;

class DistiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disti = Distributor::paginate(7);

        return view('admin.distributor.index',compact('disti'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(),[
        //     'NamaClient' => 'required',
        //     "NamaProject" =>'required',
        //     "UploadDocument"=> 'required',
        //     "Date" => 'required',
        //     // "Angka" => 'required',
        //     "Status" => 'required',
        //     //"sign_pmLead" =>'required',
        //     "principal" => 'required',
        //     "distributor" => 'required',
        // ]);    
        
        // if($validator->fails()) {
        //     return back()->with('error', 'Please provide all value!');
        // }

        Distributor::create([
            "distributor"    => $request->distributor,
            "alamat_disti"   => $request->alamat_disti,
            "email"          => $request->email,
            "no_telp"        => $request->noTelephone
        ]);

        return redirect('disti')->with('success', 'Data berhasil di dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $detailId = Distributor::find($id);

        return view('admin.distributor.show', compact('detailId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editData = Distributor::find($id);

        return view('admin.distributor.edit', compact('editData'));
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
        $getData = Distributor::find($id);

            $getData->update([
                "distributor"    => $request->distributor,
                "alamat_disti"   => $request->alamat_disti,
                "email"          => $request->email,
                "no_telp"        => $request->noTelephone
        ]);

        return redirect('disti')->with('success', 'account berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Distributor::find($id);
        $data->delete();

        return back()->with('success', 'account berhasil di hapus!');
    }
}
