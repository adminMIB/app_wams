<?php

namespace App\Http\Controllers\PM;

use App\Http\Controllers\Controller;
use App\Models\Bast;
use App\Models\DokumenProject;
use App\Models\ListProjet;
use App\Models\Produk;
use App\Models\ProjectTimeline;
use App\Models\SalesOrder;
use App\Models\TaskDiscussion;
use App\Models\Weekly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class ProjectController extends Controller
{
    public function index(){

        $data = SalesOrder::orderBy('created_at', 'desc')->get();
        return view('projects.index',compact('data'));
    }

    public function DetailProject($id){

        $shorder = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies','bast.so','dokumen_projects.lto')->find($id);
        $user = Role::with('users')->where('name', 'Technikal')->get();
        return view('projects.detail_project',compact('shorder','user'));
    }

    public function Bast($id)
    {
        $bs = SalesOrder::find($id);
        return view('projects.bast',compact('bs'));
    }

    public function Dokumen($id)
    {
        $dk = SalesOrder::find($id);
        return view('projects.dokumen',compact('dk'));
    }

    public function show($id)
    {
        $data= Weekly::find($id);
        return view('projects.edit',compact('data'));
    }

    public function store(Request $request)
    {
        $request->request->add(['user_id'=> auth()->user()->id]);
        $dc = TaskDiscussion::create($request->all());
        return redirect()->back();
    }

    public function storebast(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "bast_dokumen" => "required",
            "status" => "required",

        ]);
        if ($validate->fails()) {
            return back()->with('error', 'Field cannot be empty!');
        }

        $file_dokumen = $request->file('bast_dokumen');
        $file_dokumen_ext = $file_dokumen->getClientOriginalName();
        $file_dokumen_name = time(). $file_dokumen_ext;
        $file_dokumen_path = public_path('bast_dokumen/');
        $file_dokumen->move($file_dokumen_path, $file_dokumen_name);

        $data = $request->all();
        
        $time = new Bast;

        $time->status=$data['status'];
        $time->so_id=$data['so_id'];
        $time->bast_dokumen=$data['bast_dokumen']=$file_dokumen_name;
        $time->save();

        $so = SalesOrder::find($time->so_id);

        $so->update([
            "st_project" => $request->status, 
        ]);

            return back()->with('success', 'Data Berhasil Di Simpan');
        
    }

    public function storeDP(Request $request)
    {

        $validate = Validator::make($request->all(), [
            "dokumen_project" => "required",
            "deskripsi" => "required",

        ]);
        if ($validate->fails()) {
            return back()->with('error', 'Field cannot be empty!');
        }

        $file_dokumen = $request->file('dokumen_project');
        $file_dokumen_ext = $file_dokumen->getClientOriginalName();
        $file_dokumen_name = time(). $file_dokumen_ext;
        $file_dokumen_path = public_path('dokumen_project/');
        $file_dokumen->move($file_dokumen_path, $file_dokumen_name);

        $data = $request->all();
        
        $time = new DokumenProject;

        $time->so_id=$data['so_id'];
        $time->dokumen_project=$data['dokumen_project']=$file_dokumen_name;
        $time->deskripsi=$data['deskripsi'];
        $time->save();

        return redirect()->back();
    }

    public function updatebast(Request $request,$id)
    {
        $bast = Bast::findOrFail($id);

        if ($request->hasFile('bast_dokumen')) {
            if($request->file('bast_dokumen')->isValid()) {
                $file = $request->file('bast_dokumen');
                $image = base64_encode($file);
                $name = $file->getClientOriginalName();
                $file->move('bast_dokumen/',$name);
            }
        }
        $bast->status =  $request->status;
        $bast->bast_dokumen =  $request->bast_dokumen=!empty($request->bast_dokumen) ? $request->bast_dokumen = $name : $bast->bast_dokumen;
        $bast->save();

        $so = SalesOrder::find($bast->so_id);

        $so->update([
            "st_project" => $request->status, 
        ]);

        return redirect()->back();
    }


    public function updateP(Request $request,$id)
    {
        $p = SalesOrder::find($id);
        $p -> start_date = $request -> start_date;
        $p -> end_date = $request -> end_date;
        $p -> save();

        return redirect()->back();
    }

    public function createnewtimeline($id)
    {
        // $datas = ListToPm::all()->count();
        // $data = ListToPm::all();
        $user = Role::with('users')->where('name', 'Technikal')->get();
        $shorder = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies','bast.so','dokumen_projects.lto')->find($id);
        return view('projects.addnewtimeline', compact('shorder','user'));
    }

    public function addnewtimeline(Request $request, $id)
    {
        $time = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies','bast.so','dokumen_projects.lto')->find($id);

        $data1=$request->all();

        if (count($data1['nama_technical'])) {
            foreach ($data1['start_date'] as $item => $value) {
                $data2 = array(
                    'list_id' => $time->id,
                    'start_date' => $data1['start_date'][$item],
                    'finish_date' => $data1['finish_date'][$item],
                    'jenis_pekerjaan' => $data1['jenis_pekerjaan'][$item],
                    'nama_technical' => $data1['nama_technical'][$item],
                );

                ProjectTimeline::create($data2);
            }

            return redirect()->back()->with('success', 'Data Berhasil Di Simpan');
        }
    }

   
}
