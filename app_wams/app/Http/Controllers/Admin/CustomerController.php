<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{

    public function index()
    {
        $data = Customer::paginate(10);
        $jumlahDataCutomer = Customer::count();
        $noCustomer = 1;

        if ($jumlahDataCutomer  == 0) {
            $ResultsnoCustomer = 'CUS'.sprintf("%03s", $noCustomer);
        } else {
            $ambilNoUrutuSeblumnya = Customer::all()->last();
            $nomoerUrut = (int)substr($ambilNoUrutuSeblumnya->IDCustomer, -3) + 1;
            $ResultsnoCustomer = 'CUS'.sprintf("%03s", $nomoerUrut);
        }

        // return $data;
        return view('admin.customer.index', compact('data', 'ResultsnoCustomer'));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'namaCustomer'  => 'required',
            "noTelephone"   =>'required',
            "alamat"        => 'required',
        ]);    

        if($validator->fails()) {
            return back()->with('error', 'Silahkan isi data NAMA, NO_TELP DAN ALAMAT!');
        }
        
        $cel = Customer::create([
            "nama"         => $request->namaCustomer,
            "IDCustomer"   => $request->idCustomer,
            "email"        => $request->email,
            "no_telp"      => $request->noTelephone,
            "alamat"       => $request->alamat,
            "pic_name"     => $request->pic_name,
            "position"     => $request->position,
            "influencer_name" => $request->influencer_name,
            "influencer_position" => $request->influencer_position,
            "telp_influencer" => $request->telp_influencer,
            "influencer_email" => $request->influencer_name
        ]);

    return redirect('customer')->with('success', 'Data Customer Berhasil Dibuat!');
    }

    public function show($id)
    {
        $detailId = Customer::find($id);
        return view('admin.customer.show', compact('detailId'));
    }

    public function edit($id)
    {
        $editData = Customer::find($id);
        return view('admin.customer.edit', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $getData = Customer::find($id);
            $getData->update([
                "nama"     => $request->namaCustomer,
                "pic_name" => $request->pic_name,
                "position" => $request->position,
                "email"    => $request->email,
                "no_telp"  => $request->noTelephone,
                "alamat"   => $request->alamat,
                "influencer_name" => $request->influencer_name,
                "influencer_position" => $request->influencer_position,
                "telp_influencer" => $request->telp_influencer,
                "influencer_email" => $request->influencer_email
        ]);

        return redirect('customer')->with('success', 'Data Customer Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $data = Customer::find($id);
        $data->delete();

        return back()->with('success', 'Data Berhasil Di Hapus!');
    }
}
