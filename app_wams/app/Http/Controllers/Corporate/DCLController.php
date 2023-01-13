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
            
            return redirect()->back()->with('success', 'Berhasil buat Project/Oppty');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function indexTmakerdcl($id)
    {
        $item = PicDistributor::find($id);

        return view('corporate.dcl.tmakerdcl.create', compact('item'));
    }
    
    public function createTmakerdcl()
    {
        $sbu = Sbu::all();

        return view('corporate.dcl.tmakerdcl.create', compact('sbu'));
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

            $time->tanggal_reimbursement    = $data1['tanggal_reimbursement'];
            $time->nama_pic_reimbursement   = $data1['nama_pic_reimbursement'];
            $time->nominal_reimbursement    = $data1['nominal_reimbursement'];
            $time->pic_business_channel     = $data1['pic_business_channel'];
            $time->client                   = $data1['client'];
            $time->pic_client               = $data1['pic_client'];
            $time->file_po_client           = $data1['file_kwitansi'] = $file_po_client_name;
            $time->file_po_mib              = $data1['file_MoM'] = $file_po_mib_name;
            $time->save();
            
            return redirect()->back()->with('success', 'Berhasil buat Transaction Maker');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
