<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Divisi;
use App\Models\OpptyProject;
use App\Models\PersonelTeam;
use App\Models\TransactionMakerReimbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReimbursementController extends Controller
{
    public function indexPersonelteam()
    {
        $divisi = Divisi::all();
        $personel = PersonelTeam::all();

        return view('corporate.reimbursement.personelteam.index', compact('divisi','personel'));
    }
    
    public function storePersonelteam(Request $request)
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
            
            $pt = new PersonelTeam;
            
            $pt->divisi=$request->divisi;
            $pt->nama_personel=$request->nama_personel;
            $pt->save();
            
            return redirect()->back()->with('success', 'Berhasil buat Personel');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function indexClient()
    {
        $cstmr = Customer::all();
        
        return view('corporate.reimbursement.clientreim.index', compact('cstmr'));
    }
    
    public function createClient()
    {
        $jumlahDataCutomer = Customer::count();
        $noCustomer = 1;

        if ($jumlahDataCutomer  == 0) {
            $ResultsnoCustomer = 'CUS'.sprintf("%03s", $noCustomer);
        } else {
            $ambilNoUrutuSeblumnya = Customer::all()->last();
            $nomoerUrut = (int)substr($ambilNoUrutuSeblumnya->IDCustomer, -3) + 1;
            $ResultsnoCustomer = 'CUS'.sprintf("%03s", $nomoerUrut);
        }
        
        return view('corporate.reimbursement.clientreim.create', compact('ResultsnoCustomer'));
    }
    
    public function storeClient(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'namaCustomer'  => 'required',
            "noTelephone"   =>'required',
            "alamat"        => 'required',
        ]);    
        
        if($validator->fails()) {
            return back()->with('error', 'Silahkan isi data NAMA, NO_TELP DAN ALAMAT!');
        }
        
        Customer::create([
            "nama"         => $request->namaCustomer,
            "IDCustomer"   => $request->idCustomer,
            "email"        => $request->email,
            "no_telp"      => $request->noTelephone,
            "alamat"       => $request->alamat,
            "no_hp"        => $request->no_hp,
            "nama_pic"     => $request->nama_pic,
            "jabatan_pic"  => $request->jabatan_pic
        ]);

        return redirect('Client-Reimbursement')->with('success', 'Data Customer Berhasil Dibuat!');
        
    }
    
    public function indexOpptyproject()
    {
        $op = OpptyProject::all();
    
        return view('corporate.reimbursement.opptyproject.index', compact('op'));
    }
    
    public function createOpptyproject()
    {
        return view('corporate.reimbursement.opptyproject.create');
    }

    public function storeOpptyproject(Request $request)
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
            
            OpptyProject::create([
                "jenis"                 => $request->jenis,
                "ID_opptyproject"       => $request->ID_opptyproject,
                "nama_project"          => $request->nama_project,
                "pic_bussiness_channel" => $request->pic_bussiness_channel,
                "client"                => $request->client
            ]);
            
            return redirect()->back()->with('success', 'Berhasil buat Project/Oppty');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function CreateTMReim($id)
    {
        $item= OpptyProject::find($id);
        return view('corporate.reimbursement.transactionmaker.create',compact('item'));
    }

    // public function indexTmakerreimburs()
    // {
    //     $tmreim = TransactionMakerReimbursement::all();

    //     return view('corporate.reimbursement.transactionmaker.index', compact('tmreim'));
    // }

    public function showTMReim($id)
    {
        $tmreim = OpptyProject::with('detailtmreim')->find($id);
        return view('corporate.reimbursement.transactionmaker.index', compact('tmreim'));
    }
    
    public function editTmReim($id)
    {
        $item= TransactionMakerReimbursement::find($id);
        $opptprjt = OpptyProject::all();

        return view('corporate.reimbursement.transactionmaker.edit',compact('item', 'opptprjt'));
    }

    public function storeTmakerreimburs(Request $request)
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

            $file_kwitansi = $request->file('file_kwitansi');
            $file_kwitansi_ext = $file_kwitansi->getClientOriginalName();
            $file_kwitansi_name = time(). $file_kwitansi_ext;
            $file_kwitansi_path = public_path('fileCorporate/');
            $file_kwitansi->move($file_kwitansi_path, $file_kwitansi_name);
            
            $file_MoM = $request->file('file_MoM');
            $file_MoM_ext = $file_MoM->getClientOriginalName();
            $file_MoM_name = time(). $file_MoM_ext;
            $file_MoM_path = public_path('fileCorporate/');
            $file_MoM->move($file_MoM_path, $file_MoM_name);
            
            $data1=$request->all();

            $time = new TransactionMakerReimbursement;

            $time->opptyproject_id          = $data1['opptyproject_id'];
            $time->tanggal_reimbursement    = $data1['tanggal_reimbursement'];
            $time->nama_pic_reimbursement   = $data1['nama_pic_reimbursement'];
            $time->nominal_reimbursement    = $data1['nominal_reimbursement'];
            $time->pic_business_channel     = $data1['pic_business_channel'];
            $time->client                   = $data1['client'];
            $time->pic_client               = $data1['pic_client'];
            $time->file_kwitansi            = $data1['file_kwitansi'] = $file_kwitansi_name;
            $time->file_MoM                 = $data1['file_MoM'] = $file_MoM_name;
            $time->save();
            
            return redirect()->back()->with('success', 'Berhasil buat Transaction Maker');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    
    public function updateTmakerreimburs(Request $request, $id)
    {
        $edittm = TransactionMakerReimbursement::find($id);

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

            // $data1=$request->all();

            $edittm->update([
                "nama_pic_reimbursement" => $request->nama_pic_reimbursement,
                "pic_business_channel" => $request->pic_business_channel,
                "opptyproject_id" => $request->opptyproject_id,
            ]);
            
            return redirect()->back()->with('success', 'Berhasil buat Transaction Maker');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroyPersonel($id)
    {
        PersonelTeam::find($id)->delete();
 
        return back()->with('success', 'data berhasil di hapus');
    }
    
    public function destroyClient($id)
    {
        Customer::find($id)->delete();
 
        return back()->with('success', 'data berhasil di hapus');
    }
    
    public function destroyOpptyproject($id)
    {
        $op = OpptyProject::find($id);

        $tmre = TransactionMakerReimbursement::all();

        foreach ($tmre as $key => $v) {
            $amid = $op->id; // 2 -> tabel salesorder

            if ($amid ==  $v->opptyproject_id) {
                // return $v->id;
                TransactionMakerReimbursement::find($v->id)->delete();
            }
        }

        $op->delete();
 
        return back()->with('success', 'data berhasil di hapus');
    }
}
