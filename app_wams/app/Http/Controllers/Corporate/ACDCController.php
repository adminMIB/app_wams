<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\CreateClient;
use App\Models\CreatePrincipal;
use App\Models\CreateProject;
use App\Models\CreateWeekly;
use App\Models\TransactionMakerACDC;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ACDCController extends Controller
{
    public function indexCP ()
    {
        $cp = CreatePrincipal::all();
        return view('corporate.ACDC.CreatePrincipal.indexCP',compact('cp'));
    }

    public function saveCP (Request $request)
    {
        
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

        CreateClient::create([
            "client_type" => $request->client_type,
            "client_name" => $request->client_name
        ]);

        return redirect()->back();
    }

    //Create Project

    public function indexCPT ()
    {
        $cpt = CreateProject::all();
        return view('corporate.ACDC.CreateProject.indexCPT',compact('cpt'));
    }

    public function createCPT ()
    {
        $cp = CreatePrincipal::all();
        $cc = CreateClient::all();
        return view ('corporate.ACDC.CreateProject.createCPT',compact('cp','cc'));
    }

    public function saveCPT (Request $request)
    {

        $file = $request -> file('file');
        $file_ext = $file -> getClientOriginalName();
        $file_name = time(). $file_ext;
        $file_path = public_path ('file_hitungan/');
        $file -> move ($file_path, $file_name);

        CreateProject::create([
            "id_project" => $request -> id_project,
            "project_name" => $request -> project_name,
            "principal_name" => $request -> principal_name,
            "client_name" => $request -> client_name,
            "file" => $request ->file = $file_name,
            "bmt" => $request -> bmt,
            "services" => $request -> services,
            "lain" => $request -> lain,
            "subtotal" => $request -> subtotal,
            "bunga_admin" => $request -> bunga_admin,
            "biaya_admin" => $request -> biaya_admin,
            "biaya_pengurangan" => $request -> biaya_pengurangan,
            "total_final" => $request -> total_final,

        ]);

        return redirect ('/index-createproject');

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
            "cpt_id" => $tm->id,
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

    
    public function showCPT($id)
    {
        $cpt = CreateProject::find($id);
        $cptac = CreateProject::with('detail')->where('id', $id)->first();
        return view('corporate.ACDC.CreateProject.showCPT', compact('cpt','cptac'));
    }

    public function editTM($id)
    {
        $pt = CreateProject::all();
        $item= TransactionMakerACDC::with('cpt')->find($id);
        return view('corporate.ACDC.CreateProject.editTM',compact('item','pt'));
    }

    public function cpt(Request $request)
    {
        $id = $request->id;
        $data = CreateProject::find($id);
        return response()->json($data);
    }
}
