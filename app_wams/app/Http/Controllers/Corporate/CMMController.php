<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\CreateBank;
use App\Models\CreatePRK;
use App\Models\TransactionMakerCMM;
use Illuminate\Http\Request;

class CMMController extends Controller
{
    public function indexCB() 
    {
        $cb = CreateBank::all();
        return view('corporate.CMM.CreateBank.indexCB',compact('cb'));
    }

    public function saveCB(Request $request)
    {
        CreateBank::create([
            "nama_bank" => $request-> nama_bank,
            "alamat" => $request-> alamat,
            "pic_bank" => $request->pic_bank,
            "email_pic_bank" => $request->email_pic_bank,
            "hp_pic_bank" => $request->hp_pic_bank,
        ]);

        return redirect()->back();
    }

    //Create PRK
    public function indexCPRK()
    {
        $cprk = CreatePRK::all();
        return view('corporate.CMM.CreatePRK.indexPRK',compact('cprk'));
    }

    public function saveCPRK(Request $request)
    {
        CreatePRK::create([
            "pengajuan_cl" => $request -> pengajuan_cl,
            "jumlah_cl" => $request -> jumlah_cl,
            "jenis_kolateral" => $request -> jenis_kolateral,
            "keterangan" => $request -> keterangan,
        ]);

        return redirect()->back();
    }

    //Create Transaction Maker
    public function indexTMCMM()
    {
        $tmcmm = TransactionMakerCMM::all();
        return view('corporate.CMM.TransactionMakerCMM.indexTM-CMM',compact('tmcmm'));
    }

    public function saveTMCMM(Request $request)
    {
        TransactionMakerCMM::create([
            "tgl_po" => $request -> tgl_po,
            "nama_project" => $request -> nama_project,
            "nama_klien" => $request -> nama_klien,
            "nama_eu" => $request -> nama_eu,
            "nominal_po" => $request -> nominal_po,
        ]);

        return redirect()->back();
    }
}
