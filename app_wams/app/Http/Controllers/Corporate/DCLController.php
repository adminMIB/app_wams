<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Models\PersonelTeam;
use App\Models\PicDistributor;
use App\Models\Sbu;
use App\Models\TransactionMakerDcl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DCLController extends Controller
{
    public function indexdisti()
    {
        $disti = Distributor::all();

        return view('corporate.dcl.disti.index', compact('disti'));
    }
    public function storedisti(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                // "jumlah_saldo" => "required|string|max:30",
                // "institusi" => "required|string",
                // "project" => "required|string",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $dst = new Distributor;

            $dst->distributor=$request->distributor;
            $dst->alamat_disti=$request->alamat_disti;
            $dst->save();

            return redirect()->back()->with('success', 'Berhasil Create Distributor');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    
    public function indexsbu()
    {
        $sbu = Sbu::all();
        $psteam = PersonelTeam::all();

        return view('corporate.dcl.sbu.index', compact('sbu', 'psteam'));
    }

    public function editSbu($id)
    {
        $sbu = Sbu::find($id);
        
        return response()->json($sbu);
    }

    public function updateSbu(Request $request, $id)
    {
        $sbu = Sbu::find($id);

        $sbu->update([
            'name' => $request->name,
            'picSales' => $request->pic
        ]);

        return redirect()->back()->with(['success' => "SBU $sbu->name berhasil diubah"]);
    }

    public function storesbu(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                // "jumlah_saldo" => "required|string|max:30",
                // "institusi" => "required|string",
                // "project" => "required|string",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $dst = new Sbu();

            $dst->name=$request->name;
            $dst->PicSales=$request->PicSales;
            $dst->save();

            return redirect()->back()->with('success', 'Berhasil Create SBU');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function indexPic()
    {
        $pic = PicDistributor::all();

        return view('corporate.dcl.picdisti.index', compact('pic'));
    }
    
    public function createPic()
    {
        $dst = Distributor::all();

        return view('corporate.dcl.picdisti.create', compact('dst'));
    }

    public function storePic(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                // "jumlah_saldo" => "required|string|max:30",
                // "institusi" => "required|string",
                // "project" => "required|string",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);
            
            if ($validate->fails()) {
                return response()->json($validate->errors());
            }
            
            PicDistributor::create([
                "nama_disti"    => $request->nama_disti,
                "pic_disti"     => $request->pic_disti,
                "jabatan_pic"   => $request->jabatan_pic,
                "email_pic"     => $request->email_pic,
                "nomor_hp"      => $request->nomor_hp,
                "pengajuan_cl"  => $request->pengajuan_cl,
                "jumlah_cl"     => $request->jumlah_cl
            ]);
            
            return redirect(route('dclsbuindex'))->with('success', 'Berhasil buat DCL');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function indexTmakerdcl($id)
    {
        $item = PicDistributor::find($id);
        $sbu = Sbu::all();

        return view('corporate.dcl.tmakerdcl.create', compact('item', 'sbu'));
    }
    
    public function showTmakerdcl($id)
    {
        $tmdcl = PicDistributor::find($id);

        return view('corporate.dcl.tmakerdcl.index', compact('tmdcl'));
    }

    public function storeTmakerdcl(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                // "jumlah_saldo" => "required|string|max:30",
                // "institusi" => "required|string",
                // "project" => "required|string",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);
            
            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $totalpo = 0;
            $tmDcl = TransactionMakerDcl::where("picdisti_id", $request->picdisti_id)->get();

            foreach($tmDcl as $row) {
                $totalpo += $row->nominal_po;
            }

            $saldo_pic_disti = PicDistributor::find($request->picdisti_id)->first('jumlah_cl');
            $sisa_saldo = $saldo_pic_disti->jumlah_cl - $totalpo;

            if ($request->nominal_po > $sisa_saldo) {
                return redirect()->back()->with(['error' => "Saldo PIC Disti Tidak Cukup"]);
            } else {
                $file_po_client = $request->file('file_po_client');
                $file_po_client_ext = $file_po_client->getClientOriginalName();
                $file_po_client_name = time(). $file_po_client_ext;
                $file_po_client_path = public_path('fileCorporate/');
                $file_po_client->move($file_po_client_path, $file_po_client_name);
                
                $file_po_mib = $request->file('file_po_mib');
                $file_po_mib_ext = $file_po_mib->getClientOriginalName();
                $file_po_mib_name = time(). $file_po_mib_ext;
                $file_po_mib_path = public_path('fileCorporate/');
                $file_po_mib->move($file_po_mib_path, $file_po_mib_name);
                
                $data1=$request->all();

                $time = new TransactionMakerDcl;

                $time->picdisti_id              = $data1['picdisti_id'];
                $time->tanggal_po               = $data1['tanggal_po'];
                $time->nama_project             = $data1['nama_project'];
                $time->nama_client              = $data1['nama_client'];
                $time->nama_eu                  = $data1['nama_eu'];
                $time->nominal_po               = $data1['nominal_po'];
                $time->nama_sbu                 = $data1['nama_sbu'];
                $time->nama_pic                 = $data1['nama_pic'];
                $time->pic_business_channel     = $data1['pic_business_channel'];
                $time->file_po_client           = $data1['file_po_client'] = $file_po_client_name;
                $time->file_po_mib              = $data1['file_po_mib'] = $file_po_mib_name;
                $time->save();
                
                return redirect()->back()->with('success', 'Berhasil buat Transaction Maker');
            }
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroydisti($id)
    {
        Distributor::find($id)->delete();
 
        return back()->with('success', 'data berhasil di hapus');
    }
    
    public function destroysbu($id)
    {
        Sbu::find($id)->delete();
 
        return back()->with('success', 'data berhasil di hapus');
    }

    public function destroypicdisti($id)
    {
        $op = PicDistributor::find($id);

        $tmre = TransactionMakerDcl::all();

        foreach ($tmre as $key => $v) {
            $amid = $op->id; // 2 -> tabel salesorder

            if ($amid ==  $v->picdisti_id) {
                // return $v->id;
                TransactionMakerDcl::find($v->id)->delete();
            }
        }

        $op->delete();
 
        return back()->with('success', 'data berhasil di hapus');
    }
}
