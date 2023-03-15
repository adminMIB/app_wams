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

        return redirect()->back()->with(['success' => 'data berhasil ditambahkan']);   
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

        return redirect()->back()->with(['success' => 'data berhasil ditambahkan']);   
    }

    //Create Transaction Maker
    public function CreateTMCMM($id)
    {
        $item= CreatePRK::find($id);
        return view('corporate.CMM.TransactionMakerCMM.indexTM-CMM',compact('item'));
    }

    public function saveTMCMM(Request $request,$id)
    {
        $tm = CreatePRK::with('tmcmm')->find($id);

        $totalPo = 0;
        $tmTMCMM = TransactionMakerCMM::where('cmm_id', $tm->cmm_id)->get();

        foreach($tmTMCMM as $row) {
            $totalPo += $row->nominal_po;
        }

        $sisa_saldo = $tm->jumlah_cl - $totalPo;

        if ($request->nominal_po > $sisa_saldo) {
            return redirect()->back()->with(['error' => "Saldo CMM Disti Tidak Cukup"]);
        } else {
            TransactionMakerCMM::create([
                "cmm_id" => $tm->id,
                "tgl_po" => $request -> tgl_po,
                "nama_project" => $request -> nama_project,
                "nama_klien" => $request -> nama_klien,
                "nama_eu" => $request -> nama_eu,
                "nominal_po" => $request -> nominal_po,
            ]);
    
            return redirect()->back()->with(['success' => 'data berhasil ditambahkan']);   
        }
    }

    public function detailTMCMM($id)
    {
        $dtmcmm = CreatePRK::with('tmcmm')->find($id);
        return view('corporate.CMM.TransactionMakerCMM.detailTMCMM',compact('dtmcmm'));
    }

    public function deleteCB($id)
    {
        $cb = CreateBank::find($id);
        $cb->delete();
        return back();
    }

    public function deletePRK($id)
    {
        $so = CreatePRK::find($id);
        $am = TransactionMakerCMM::all();
        
        foreach ($am as $key => $v) {
            $amid = $so->id; // 2 -> tabel salesorder

            if ($amid ==  $v->cmm_id) {
                TransactionMakerCMM::find($v->id)->delete();
            }
        }

        $so->delete();
        return redirect()->back()->with('success','Data berhasil di hapus');
    }
}
