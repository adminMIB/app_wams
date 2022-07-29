<?php

namespace App\Http\Controllers;

use App\Models\ListProjectPm;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\ListprojectpmNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class ListProjectPmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cb = ListProjectPm::all();
        $user=Role::with('users')->where('name', 'PM')->get();
      
         return view('listprojectpm', compact('cb','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        ListProjectPm::create([

            "no_sales"  => $request->no_sales,
            "tgl_sales"  => $request->tgl_sales,
            "nama_sales"  => $request->nama_sales,
            "nama_institusi"  => $request->nama_institusi,
            "nama_project"  => $request->nama_project,
            "hps"  => $request->hps,
            "sign_pm_lead" => $request->sign_pm_lead,
        ]);
   
        return redirect('listprojectpm')->with('success', 'Task Created Successfully!');
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

    public function listprojectpm(Request $request)
    {
        $id = $request->id;
        $data = ListProjectPm::find($id);
        return response()->json($data);
    }
}
