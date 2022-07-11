<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ProjectTimeline;
use Illuminate\Http\Request;

class ProjectTimeLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getData = ProjectTimeline::orderBy("created_at", "DESC")->paginate();
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
        ProjectTimeline::create([
            "nama_institusi" => $request->nama_institusi,
            "nama_project" => $request->nama_project,
            "nama_sales" => $request->nama_sales,
            "project_timeline" => $request->project_timeline,
            "sign_to" => $request->sign_to,
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
        $getID = ProjectTimeline::find($id);

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
            $getData = ProjectTimeline::findOrFail($id);
            $getData->update([
                "nama_insitusi" => $request->nama_insitusi,
                "nama_project" => $request->nama_project,
                "nama_sales" => $request->nama_sales,
                "project_timeline" => $request->project_timeline,
                "sign_to" => $request->sign_to,
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
        $deletData = ProjectTimeline::find($id);
        $deletData->delete();

        return response()->json([
            "status" => true,
            "message" => "data berhasil dihapus",
            "results" => $deletData
        ]);
    }
}