<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ViewWeeklyReport;
use Illuminate\Http\Request;

class ViewWeeklyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = ViewWeeklyReport::orderBy("created_at", "DESC")->paginate();
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
        ViewWeeklyReport::create([
            "nama_client" => $request->nama_client,
            "nama_project" => $request->nama_project,
            "uraian_pekerjaan" => $request->uraian_pekerjaan,
            "date" => $request->date,
            "status" => $request->status,
            "note" => $request->note,
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
        $getID = ViewWeeklyReport::find($id);

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
            $getData = ViewWeeklyReport::findOrFail($id);
            $getData->update([
                "nama_client" => $request->nama_client,
                "nama_project" => $request->nama_project,
                "uraian_pekerjaan" => $request->uraian_pekerjaan,
                "date" => $request->date,
                "status" => $request->status,
                "note" => $request->note,
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
        $deletData = ViewWeeklyReport::find($id);
        $deletData->delete();

        return response()->json([
            "status" => true,
            "message" => "data berhasil dihapus",
            "results" => $deletData
        ]);
    }
}
