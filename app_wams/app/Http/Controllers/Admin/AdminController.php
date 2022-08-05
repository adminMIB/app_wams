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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = Auth::user();
        $admin = ListProjectAdmin::with('pmLead', 'technikelLead', 'sales')->orderBy("created_at", "DESC")->paginate(10);
    //    $admin =  ListProjectAdmin::where("signPm_lead", $user->id )->with('pmLead', 'technikelLead')->orderBy("created_at", "DESC")->paginate(10); 
        // $admin = User::with('listAdmin')->orderBy("created_at", "DESC")->paginate();

        return view('admin.index', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $admin = ListProjectAdmin::orderBy('created_at', 'DESC')->paginate(10);
        $pmLead = Role::with('users')->where("name", "PM Lead")->get();
        $TechnikelLead = Role::with('users')->where("name", "Technikal Lead")->get();
        $sales = Role::with('users')->where("name", "AM/Sales")->get();


        return view('admin.create', compact('admin', 'pmLead', 'TechnikelLead', 'sales'));
    }

    // function dwonload document bentuk zip
    public function downZip(Request $request)
    {

        if($request->has('download')) {
            $zip      = new ZipArchive;
            $fileName = 'document.zip';
            if ($zip->open(public_path(!$fileName), ZipArchive::CREATE) === TRUE) {
                $files = File::files(public_path('/admin'));
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
            'NamaClient' => 'required',
            'NamaProject' => 'required',
            'UploadDocument' => 'required',
            'Date' => 'required',
            'Angka' => 'required',
            'Status' => 'required',
            'Note' => 'required',
            'signPm_lead' => 'required',
            'signTechnikel_lead' => 'required',
            'signAmSales_id' => 'required'

        ]);


        // upload dokumen
        // ambil data nya lalu simpan di divariabel data
        $data = $request->UploadDocument ;
        // buat name kosoingnya
        $name = '';
        foreach ($data as $dokumen) {
            $fileName = $dokumen->getClientOriginalName();
            $dokumen->move(public_path() . '\admin', $fileName);
            $name = $name . $fileName . "\n"  ;
        }

        // //   $s =  explode(" ",$request->UploadDocument = $name);

        ListProjectAdmin::create([
            "NamaClient" => $request->NamaClient,
            "NamaProject" => $request->NamaProject,
            "UploadDocument"=> $request->UploadDocument = $name,
            "Date" => $request->Date,
            "Angka" => $request->Angka,
            "Status" => $request->Status,
            "Note" => $request->Note,
            "signPm_lead" => $request->signPm_lead,
            "signTechnikel_lead" => $request->signTechnikel_lead,
            "signAmSales_id" =>$request->signAmSales_id,
        ]);

        return redirect('adminproject');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detailId = ListProjectAdmin::find($id);

        // return $detailId;

        return view('admin.show', compact('detailId'));

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
}
