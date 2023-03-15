<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\CreateClient;
use App\Models\CreatePrincipal;
use App\Models\CreateProject;
use App\Models\TransactionMakerACDC;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ACDCController extends Controller
{
    public function indexCP ()
    {
        $cp = CreatePrincipal::all();
        return view('corporate.ACDC.CreatePrincipal.indexCP',compact('cp'));
    }

    public function updateProjectAcdc(Request $request, $id)
    {
        $data = CreateProject::find($id);

        if (!empty($request->file)) {
            unlink("/file_hitungan/$data->file");
            $extention = $request->file('file')->getClientOriginalExtension();
            $name = base64_encode(random_bytes(18)) . time();
            $request->file->move(public_path('file_hitungan'), $name . '.' . $extention);
            $fileName = $name . '.' . $extention;
        }

        $data->update([
            "id_project" => $request->id_project,
            "project_name" => $request->project_name,
            "principal_name" => $request->principal_name,
            "client_name" => $request->client_name,
            "file" => empty($request->file) ? $data->file : $fileName,
            "bmt" => str_replace(".", "", $request->bmt),
            "services" => str_replace(".", "", $request->services),
            "lain" => empty($request->other) ? $request->lain : 0,
            "subtotal" => $request->subtotal,
            "bunga_admin" => $request->bunga_admin,
            "biaya_admin" => $request->biaya_admin,
            "biaya_pengurangan" => str_replace(".", "", $request->biaya_pengurangan),
            "total_final" => $request->final_subtotal,
        ]);

        return redirect('/index-createproject')->with([
            'success' => 'Project (ACDC) - '. $data->project_name . ' berhasil diubah'
        ]);
    }

    public function getDataList(Request $request)
    {
        Carbon::setLocale('id');
        CarbonInterval::setlocale('id');

        if ($request->ajax()) {
            $data = DB::table('create_projects')
                ->select(
                    'create_projects.id',
                    'create_projects.id_project as code',
                    'create_projects.project_name as name', 
                    'create_projects.client_name',
                    'create_projects.principal_name',
                    'create_projects.total_final', 
                    'create_projects.created_at'
                )->latest('create_projects.id');

            return DataTables::of($data)
                ->addColumn('total_final', function($val) {
                    return "Rp. " . number_format($val->total_final, 2, ",", ".");
                })
                ->addColumn('created_at', function ($val) {
                    return Carbon::parse($val->created_at)->translatedFormat("Y-m-d");
                })
                ->addColumn('action', function ($val) {
                    $edit_url = route('editcp',$val->id);
                    $detail_url = route('showcpt', $val->id);

                    $btn_edit = "<a href='$edit_url' class='btn btn-warning btn-sm text-white'><i class='fa fa-edit'></i></a>";
                    $btn_detail = "<a href='$detail_url' class='btn btn-info btn-sm text-white'><i class='fa fa-eye'></i></a>";
                    $btn_delete = ' <a href="javascript:void(0)" class="btn btn-danger btn-sm delete" data-id="'.$val->id.'" title="Hapus data"><i class="fas fa-trash "></i></a>';
                    $transMaker = '<a href="javascript:void(0)" class="btn btn-primary btn-sm maker" onclick="CreateTM('. $val->id .')">Transaction Maker</a>';


                    return $btn_detail . ' ' . $btn_edit . ' ' . $btn_delete . ' ' . $transMaker;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('search')) {
                        $instance->where('create_projects.project_name', 'LIKE', '%' . request()->search . '%');
                    }

                    if (!empty($request->client)) {
                        $instance->where('client_name', $request->client);
                    }

                    if (!empty($request->principal)) {
                        $instance->where('principal_name', $request->principal);
                    }

                    if ($request->get('start_date')) {

                        $instance->whereBetween('create_projects.created_at', [
                            Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01',
                            Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59'
                        ]);
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function saveCP (Request $request)
    {
        $validator = Validator::make($request->all(),[
            'principal_type'  => 'required',
            'principal_name'  => 'required'
        ]);    

        if($validator->fails()) {
            return back()->with('error', 'Field cannot be empty!');
        }
        
        CreatePrincipal::create([
            "principal_type" => $request->principal_type,
            "principal_name" => $request->principal_name,
        ]);

        return redirect()->back();
    }

    //Create Client

    public function indexCC ()
    {
        
        $cc = CreateClient::all();
        return view('corporate.ACDC.CreateClient.indexCC',compact('cc'));
    }

    public function saveCC (Request $request)
    {

        $validator = Validator::make($request->all(),[
            'client_type'  => 'required',
            'client_name'  => 'required'
        ]);    

        if($validator->fails()) {
            return back()->with('error', 'Field cannot be empty!');
        }

        CreateClient::create([
            "client_type" => $request->client_type,
            "client_name" => $request->client_name
        ]);

        return redirect()->back();
    }

    //Create Project

    public function indexCPT (Request $request)
    {
        $client = DB::table('create_clients')->select('client_name')->get();
        $principal = DB::table('create_principals')->select('principal_name')->get();

        return view('corporate.ACDC.CreateProject.indexCPT',compact('client', 'principal'));
    }

    public function createCPT ()
    {
        $cp = CreatePrincipal::all();
        $cc = CreateClient::all();
        return view ('corporate.ACDC.CreateProject.createCPT',compact('cp','cc'));
    }

    public function editCP($id)
    {
        $cp = CreatePrincipal::all();
        $cc = CreateClient::all();

        $data = CreateProject::find($id);

        return view('corporate.ACDC.CreateProject.edit', compact('cp','cc', 'data'));
    }

    public function saveCPT (Request $request)
    {

        $file = $request->file('file');
        $file_ext = $file->getClientOriginalName();
        $file_name = time(). $file_ext;
        $file_path = public_path('file_hitungan/');
        $file->move($file_path, $file_name);

        CreateProject::create([
            "id_project" => $request->id_project,
            "project_name" => $request->project_name,
            "principal_name" => $request->principal_name,
            "client_name" => $request->client_name,
            "file" => $file_name,
            "bmt" => str_replace(".", "", $request->bmt),
            "services" => str_replace(".", "", $request->services),
            "lain" => empty($request->other) ? $request->lain : 0,
            "subtotal" => $request->subtotal,
            "bunga_admin" => $request->bunga_admin,
            "biaya_admin" => $request->biaya_admin,
            "biaya_pengurangan" => str_replace(".", "", $request->biaya_pengurangan),
            "total_final" => $request->final_subtotal,

        ]);

        return redirect('/index-createproject')->with([
            'success' => 'Project (ACDC) - '. $request->name . ' berhasil dibuat'
        ]);

    }

    public function getPojectByClient(Request $request)
    {
        $data = DB::table('create_projects')
            ->select('id', 'project_name', 'id_project', 'client_name')
            ->where("client_name", $request->client)
            ->get();
            
        return response($data);
    }

    //Transaction Maker
    public function indexTM()
    {
        $tmadc = TransactionMakerACDC::all();
        return view('corporate.ACDC.TransactionMakerACDC.indexTM-ACDC',compact('tmadc'));
    }

    public function saveTM(Request $request)
    {   
        $file_request = $request -> file('upload_request');
        $file_ext_request = $file_request -> getClientOriginalName();
        $file_name_request = time(). $file_ext_request;
        $file_path_request = public_path ('file_request/');
        $file_request -> move ($file_path_request, $file_name_request);

        $file_release = $request -> file('upload_release');
        $file_ext_release = $file_release -> getClientOriginalName();
        $file_name_release = time(). $file_ext_release;
        $file_path_release = public_path ('file_release/');
        $file_release -> move ($file_path_release, $file_name_release);

        TransactionMakerACDC::create([
            "tanggal" => $request->tanggal,
            "jenis_transaksi" => $request->jenis_transaksi,
            "nama_tujuan" => $request->nama_tujuan,
            "nominal" => $request->nominal,
            "keterangan" => $request->keterangan,
            "upload_request" => $request->upload_request = $file_name_request,
            "upload_release" => $request->upload_release = $file_ext_release,
        ]);

        return redirect()->back();
    }

    public function CreateTM($id)
    {
        $item= CreateProject::find($id);
        return view('corporate.ACDC.TransactionMakerACDC.indexTM-ACDC',compact('item'));
    }

    public function saveTMAC(Request $request,$id)
    {
        $tm = CreateProject::with('detail')->find($id);

        $file_request = $request->file('upload_request');
        $file_ext_request = $file_request->getClientOriginalName();
        $file_name_request = time(). $file_ext_request;
        $file_path_request = public_path ('file_request/');
        $file_request->move($file_path_request, $file_name_request);

        $file_release = $request->file('upload_release');
        $file_ext_release = $file_release -> getClientOriginalName();
        $file_name_release = time(). $file_ext_release;
        $file_path_release = public_path('file_release/');
        $file_release->move($file_path_release, $file_name_release);

        TransactionMakerACDC::create([
            "cpt_id" => $tm->id,
            "tanggal" => $request->tanggal,
            "jenis_transaksi" => $request->jenis_transaksi,
            "nama_tujuan" => $request->nama_tujuan,
            "nominal" => $request->nominal,
            "keterangan" => $request->keterangan,
            "upload_request" => $file_name_request,
            "upload_release" => $file_ext_release,

        ]);

        return redirect(route('showcpt', $id))->with([
            'success' => 'Transaction Maker Projek - '. $tm->project_name . ' berhasil dibuat'
        ]);
    }

    
    public function showCPT($id)
    {
        $cpt = CreateProject::with('detail')->find($id);
        return view('corporate.ACDC.CreateProject.showCPT', compact('cpt'));
    }

    public function editTM($id)
    {
        $item= TransactionMakerACDC::with('cpt')->find($id);

        $data = DB::table('create_projects')->pluck('client_name', 'id')->toArray();
        $in_client = array_unique($data);

        return view('corporate.ACDC.CreateProject.editTM',compact('item', 'in_client'));
    }

    public function editTransactionMaker($id)
    {
        $item = TransactionMakerACDC::with('cpt')->find($id);

        return view('corporate.ACDC.TransactionMakerACDC.edit',compact('item'));
    }

    public function updateTMACDC(Request $request, $id)
    {
        $edittm = TransactionMakerACDC::with('cpt')->find($id);

        try {
            $edittm->update([
                "nama_tujuan" => empty($request->nama_tujuan) ? $edittm->nama_tujuan : $request->nama_tujuan,
                "jenis_transaksi" => empty($request->jenis_transaksi) ? $edittm->jenis_transaksi : $request->jenis_transaksi,
                "nominal" => empty($request->nominal) ? $edittm->nominal : $request->nominal,
                "keterangan" => empty($request->keterangan) ? $edittm->keterangan : $request->keterangan,
                "project_name" => $request->project_name,
                "id_project" => $request->id_project,
                "cpt_id" => $request->cpt_id,
            ]);
            
            return redirect()->back()->with('success', 'Update Transaction Maker berhasil');
            
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function cpt(Request $request)
    {
        $id = $request->id;
        $data = CreateProject::find($id);
        return response()->json($data);
    }

    public function deleteCP($id)
    {
        $cp = CreatePrincipal::find($id);
        $cp->delete();
        return back();
    }

    public function deleteCC($id)
    {
        $cc = CreateClient::find($id);
        $cc->delete();
        return back();
    }

    public function deletecpt($id)
    {
        $so = CreateProject::find($id);
        $am = TransactionMakerACDC::all();
        
        foreach ($am as $key => $v) {
            $amid = $so->id; // 2 -> tabel salesorder

            if ($amid ==  $v->cpt_id) {
                TransactionMakerACDC::find($v->id)->delete();
            }
        }

        $so->delete();

        return response()->json("Data $so->project_name berhasil dihapus");
    }


}
