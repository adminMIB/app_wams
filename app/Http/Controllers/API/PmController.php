<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pm;
use Illuminate\Http\Request;


class PmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = Pm::with("projectTimeLine","ViewWeekly")->orderBy("created_at", "DESC")->paginate();
        return response()->json([
            "status" => true,
            "results" => $getData
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pm::create([
            "name" => $request->name,
            "password" => $request->password,
            "email" => $request->email,
            "role" => 1,
            "rember_token" => $request->rember_token,
            "projectTimeLine_id" => $request->projectTimeLine_id,
            "viewWeeklyReport_id" => $request->viewWeeklyReport_id
        ]);

        return response()->json([
            "status" => true,
            "results" => "nama '$request->nama', berhasil ditambahkan"
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getID = Pm::find($id);

        return response()->json([
            "status" => true,
            "results" => $getID
        ]);
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
        try {
            $getData = Pm::findOrFail($id);
            $getData->update([
                "name" => $request->name,
                "password" => $request->password,
                "email" => $request->email,
            ]);

        return response()->json([
            "status" => true,
            "message" => "data berhasil diupdate",
            "results" => $getData
        ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletData = Pm::find($id);
        $deletData->delete();

        return response()->json([
            "status" => true,
            "message" => "data berhasil dihapus",
            "results" => $deletData
        ]);
    }
}