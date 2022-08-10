<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use ZipArchive;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    private $mediaCollection = 'file_dokumen';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();
        $admin = ListProjectAdmin::orderBy("created_at", "DESC")->paginate(10);

        // $admin = ListProjectAdmin::all();
        return view('admin.index', [
            'admin' => $admin,
            'mediaCollection' => $this->mediaCollection
        ]);

        // return view('admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // buat kode project
        // AD202281001
        $now =  Carbon::now();
        $thBulan = $now->year . $now->month;
        $tabelListProjectAdmin = ListProjectAdmin::count();
        if ($tabelListProjectAdmin == 0) {
            $urut = 1001;
            $nomer = 'AD'. $thBulan. $urut;            
        }  else {
            $ambilLast = ListProjectAdmin::all()->last();
            $urut = (int)substr($ambilLast->ID_project, -4) + 1;
            $nomer = 'AD'. $thBulan. $urut;            
        }

        $admin = ListProjectAdmin::orderBy('created_at', 'DESC')->paginate(10);
        $pmLead = Role::with('users')->where("name", "PM Lead")->get();
        $TechnikelLead = Role::with('users')->where("name", "Technikal Lead")->get();
        $sales = Role::with('users')->where("name", "AM/Sales")->get();


        return view('admin.create', compact('admin', 'pmLead', 'TechnikelLead', 'sales', 'nomer'));
    }

    // function dwonload document bentuk zip
    public function downZip(Request $request)
    {

        if($request->has('download')) {
            $zip      = new ZipArchive;
            $fileName = 'document.zip';
            if ($zip->open(public_path(!$fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files(public_path('/storage'));
                // return $files;
                foreach ($files as $key => $value) {
                    $relativeName = basename($value);
                    $zip->addFile($value, $relativeName);
                }
                // $zip->close();
            }
            // dd($fileName);
            return response()->download(public_path($fileName));
        }
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'UploadDocument' => 'required',
            'NamaClient' => 'required',
            'NamaProject' => 'required',
            'Date' => 'required',
            'Angka' => 'required',
            'Status' => 'required',
            'Note' => 'required',
            // 'signPm_lead' => 'required',
            // 'signTechnikel_lead' => 'required',
            // 'signAmSales_id' => 'required'
        ]);


        $admin = ListProjectAdmin::create([
            "NamaClient" => $request->NamaClient,
            "NamaProject" => $request->NamaProject,
            "UploadDocument"=>  implode(",", $request->UploadDocument),
            "Date" => $request->Date,
            "Angka" => $request->Angka,
            "Status" => $request->Status,
            "Note" => $request->Note,
            "ID_project" => $request->ID_project,
            // "signPm_lead" => $request->signPm_lead,
            // "signTechnikel_lead" => $request->signTechnikel_lead,
            // "signAmSales_id" =>$request->signAmSales_id,
        ]);

        // foreach ($data as $dokumen) {
        //     $fileName = $dokumen->getClientOriginalName();
        //     $dokumen->move(public_path() . '\admin', $fileName);
        //     $name = $name . $fileName ;
        // }


        foreach ($request->input('UploadDocument', []) as $file) {
            $admin->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
        }

        return redirect('adminproject');

    }


    public function storeMedia(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $angka = ListProjectAdmin::all()->count();
        $detailId = ListProjectAdmin::with('pmLead', 'technikelLead', 'sales')->find($id);
        // $detailId = ListProjectAdmin::find($id);


        return view('admin.show', compact('detailId', 'angka' ));

    }

    // public function cek($id)
    // {
    //     $s = id;
    //     $cek = ListProjectAdmin::find()
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletData = ListProjectAdmin::find($id);
        
        // File::delete($updateData->image) 
        if ($deletData) {
            Storage::delete(public_path('files\admin'));
            $deletData->delete();
        }


        return back();

    }

    // public function download_local(Request $request)
    // {
    //     if (Storage::disk('local')->exists("tmp/uploads/$request->UploadDocument")) {
    //         $path = Storage::disk('local')->path("tmp/uploads/$request->UploadDocument");
    //         $content = file_get_contents($path);
    //         return response($content)->withHeaders([
    //             'Content-Type' => mime_content_type($path)
    //         ]);
    //     }
    //     // return redirect('/404');
    // }
}
