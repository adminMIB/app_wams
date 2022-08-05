<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListProjectTech;
use App\Models\ListToPm;
use App\Models\SalesOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ListProjectTechController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $list = ListToPm::all();
        $user = Role::with('users')->where('name', 'Technikal')->get();
        return view('list_technical.listproject', compact('list', 'user'));
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

        $request->validate([
            "jenis_dokumen" => "required",
            "upload_dokumen" => "required",
            "user_id" => "required"

        ], [

            'jenis_dokumen.required' => 'Field tidak boleh kosong',
            'upload_dokumen.required' => 'Field tidak boleh kosong',
            'user_id.required' => 'Field tidak boleh kosong',

        ]);

        $data = $request->upload_dokumen;
        $name = '';
        foreach ($data as $dokumen) {
            $fileName = $dokumen->getClientOriginalName();
            $dokumen->move(public_path() . '/upload_dokumen', $fileName);
            $name = $name . $fileName . ".";
        }


        $data['user_id'] = implode(",", $request->user_id);
        $data['no_sales'] =$request->nama_sales;
        $data['tgl_sales']=$request->tgl_sales;
        $data['kode_project']=$request->kode_project;
        $data['nama_institusi'] = $request->nama_institusi;
        $data['nama_project'] = $request->nama_project;
        $data['hps'] = $request->hps;
        $data['nama_sales'] = $request->nama_sales;
        $data['jenis_dokumen'] = $request->jenis_dokumen;
        $data['upload_dokumen'] = $request->upload_dokumen = $name;
        $post = ListProjectTech::create($data);
        return redirect('listproject')->with('success', 'Adit');
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
    public function work(Request $request)
    {
        $id = $request->id;
        $data = ListToPm::find($id);
        return response()->json($data);
    }
}
