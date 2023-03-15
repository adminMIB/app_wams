<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    
    public function index()
    {
        $data = Bank::paginate(10);
        
        return view('finance.Bank.index', compact('data'));
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'namaBank'      => 'required',
            "NoRekg"        =>'required',
        ]);    

        if($validator->fails()) {
            return back()->with('error', 'Please Provide All Values!');
        }
        
        $cel = Bank::create([
            "NamaBank"         => $request->namaBank,
            "NoRekg"           => $request->NoRekg,
        ]);
        return redirect('bank')->with('success', 'Data Customer Berhasil Dibuat!');
    }

    
    public function show($id)
    {
        $detailData = Bank::find($id);
        return view('finance.bank.show', compact('detailData'));
    }

    public function edit($id)
    {
        $editData = Bank::find($id);
        return view('finance.bank.edit', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $detailData = Bank::find($id);
        $validator = Validator::make($request->all(),[
            'namaBank'      => 'required',
            "NoRekg"        =>'required',
        ]);    

        if($validator->fails()) {
            return back()->with('error', 'Please Provide All Values!');
        }
        
        $cel = $detailData->update([
            "NamaBank"         => $request->namaBank,
            "NoRekg"           => $request->NoRekg,
        ]);
        return redirect('bank')->with('success', 'Data Customer Berhasil Dibuat!');
    }

    
    public function destroy($id)
    {
        $data = Bank::find($id);
        $data->delete();

        return back()->with('success', 'Data Berhasil Di Hapus!');
    }
}
