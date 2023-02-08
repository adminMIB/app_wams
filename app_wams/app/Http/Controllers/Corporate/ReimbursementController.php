<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Divisi;
use App\Models\OpptyProject;
use App\Models\PersonelTeam;
use App\Models\TransactionMakerReimbursement;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Svg\Tag\Rect;
use Yajra\DataTables\DataTables;

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
                "divisi" => "required",
                "nama_personel" => "required",
            ]);
            if ($validate->fails()) {
                return back()->with('error', 'Field cannot be empty!');
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
    
    public function indexOpptyproject(Request $request)
    {
        Carbon::setLocale('id');
        CarbonInterval::setLocale('id');

        if ($request->ajax()) {
            $data = DB::table('oppty_projects')
                ->select(
                    'oppty_projects.id',
                    'oppty_projects.jenis',
                    'oppty_projects.ID_opptyproject as code',
                    'oppty_projects.nama_project as name', 
                    'oppty_projects.pic_bussiness_channel as picBChanel',
                    'oppty_projects.client',
                    'oppty_projects.created_at'
                )->latest('oppty_projects.id');

            return DataTables::of($data)
                ->addColumn('created_at', function ($val) {
                    return Carbon::parse($val->created_at)->translatedFormat("Y-m-d");
                })
                ->addColumn('action', function ($val) {
                    $edit_url = route('reibursment.edit',$val->id);
                    $detail_url = route('show-TMReimbursement', $val->id);

                    $btn_edit = "<a href='$edit_url' class='btn btn-warning btn-sm text-white'><i class='fa fa-edit'></i></a>";
                    $btn_detail = "<a href='$detail_url' class='btn btn-info btn-sm text-white'><i class='fa fa-eye'></i></a>";
                    $btn_delete = ' <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="'.$val->id.'" title="Hapus data"><i class="fas fa-trash "></i></a>';
                    $transMaker = '<a href="javascript:void(0)" class="btn btn-primary btn-sm maker" onclick="CreateTMReim('. $val->id .')">Transaction Maker</a>';


                    return $btn_detail . ' ' . $btn_edit . ' ' . $btn_delete . ' ' . $transMaker;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')) {
                        $instance->where('oppty_projects.nama_project', 'LIKE', '%' . request()->search . '%');
                    }

                    if (!empty($request->client)) {
                        $instance->where('oppty_projects.client', $request->client);
                    }

                    if (!empty($request->jenis)) {
                        $instance->where('oppty_projects.jenis', $request->jenis);
                    }

                    if ($request->get('start_date')) {

                        $instance->whereBetween('oppty_projects.created_at', [
                            Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01',
                            Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59'
                        ]);
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }

        $client = DB::table('customers')->select('nama')->get();

        return view('corporate.reimbursement.opptyproject.index', compact('client'));
    }
    
    public function createOpptyproject()
    {
        $customer = Customer::select("id", "nama")->get();
        $pt= PersonelTeam::select("id", "nama_personel")->get();

        return view('corporate.reimbursement.opptyproject.create', compact('customer', 'pt'));
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

    public function updateOpptyProject(Request $request, $id)
    {
        try {

            $data = OpptyProject::find($id);

            $data->update([
                "jenis"                 => $request->jenis,
                "ID_opptyproject"       => $request->ID_opptyproject,
                "nama_project"          => $request->nama_project,
                "pic_bussiness_channel" => $request->pic_bussiness_channel,
                "client"                => $request->client
            ]);
            
            return redirect(route('opptyprojectindex'))->with('success', 'Project/Oppty berhasil diubah');
            
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
            
            return redirect(route('show-TMReimbursement', $data1['opptyproject_id']))->with('success', 'Berhasil buat Transaction Maker');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function viewEditTreimburs($id)
    {
        $item= TransactionMakerReimbursement::find($id);

        return view('corporate.reimbursement.transactionmaker.updateData', compact('item'));
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
                "opptyproject_id" => empty($request->opptyproject_id) ? $edittm->opptyproject_id : $request->opptyproject_id,
                "nominal_reimbursement" => empty($request->nominal_reimbursement) ? $edittm->nominal_reimbursement : $request->nominal_reimbursement,
                "tanggal_reimbursement" => empty($request->tanggal_reimbursement) ? $edittm->tanggal_reimbursement : $request->tanggal_reimbursement
            ]);
            
            return redirect()->back()->with('success', 'Berhasil update Transaction Maker');
            
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
        return response()->json("Data $op->nama_project berhasil dihapus");
 
    }
}
