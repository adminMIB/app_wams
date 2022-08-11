<?php

namespace App\Http\Controllers;

use App\Models\ListProjectPm;
use App\Models\ListToPm;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\ListprojectpmNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class ListProjectPmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cb = SalesOrder::all();
        $user = Role::with('users')->where('name', 'PM')->get();

        return view('listprojectpm', compact('cb', 'user'));
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

        $data = $request->all();
        // dd($data);

        $time = new ListToPm;
        $time->no_sales = $data['no_sales'];
        $time->tgl_sales = $data['tgl_sales'];
        $time->nama_sales = $data['nama_sales'];
        $time->kode_project = $data['kode_project'];
        $time->hps = $data['hps'];
        $time->nama_institusi = $data['nama_institusi'];
        $time->nama_project = $data['nama_project'];
        $time->nama_pmlead = Auth::user()->name;
        $time->sign_pm=$data['sign_pm'];
        $time->save();

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
        $data = SalesOrder::find($id);
        return response()->json($data);
    }
}
