<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
        $admin = ListProjectAdmin::with('pmLead', 'technikelLead')->orderBy("created_at", "DESC")->paginate(10);
    //    $admin =  ListProjectAdmin::where("signPm_lead", $user->id )->with('pmLead', 'technikelLead')->orderBy("created_at", "DESC")->paginate(10); 
        // $admin = User::with('listAdmin')->orderBy("created_at", "DESC")->paginate();

        // return $admin;
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

        return view('admin.create', compact('admin', 'pmLead', 'TechnikelLead'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ListProjectAdmin::create([
            "NamaClient" => $request->NamaClient,
            "NamaProject" => $request->NamaProject,
            "Date" => $request->Date,
            "Angka" => $request->Angka,
            "Status" => $request->Status,
            "Note" => $request->Note,
            "signPm_lead" => $request->signPm_lead,
            "signTechnikel_lead" => $request->signTechnikel_lead
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
        //
    }

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
        //
    }
}
