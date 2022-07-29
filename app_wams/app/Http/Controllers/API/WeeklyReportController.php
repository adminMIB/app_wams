<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\WeeklyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeeklyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        $data = WeeklyReport::orderBy("created_at","ASC")->paginate(10);
        return response()->json([
            "status" => true,
            "data" => $data,
        ]);
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
        $weekly_reports = new WeeklyReport();
        try {
            $validate=Validator::make($request->all(),[
                "code_project" => "required|string|max:100",
                "name_client" => "required|string|max:100",
                "name_project" => "required|string|max:200",
                "job_essay" => "required|string|max:100",
                "start_date" => "required|string|max:200",
                "end_date" => "required|string|max:200",
                "status" => "required|string|max:200",
                "note" => "required|string|max:200",
            ],[
                "code_project.required" => "Kode Project berhasil dibuat!",
                "name_client.required" => "Nama Client berhasil dibuat!",
                "name_project.required" => "Nama Project berhasil dibuat!",
                "job_essay.required" => "Uraian Pekerjaan berhasil dibuat!",
                "status.required" => "Status berhasil dibuat!",
                "note.required" => "Note berhasil dibuat!",
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            WeeklyReport::create([
                "code_project" => $request->code_project,
                "name_client" => $request->name_client,
                "name_project" => $request->name_project,
                "job_essay" => $request->job_essay,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "status" => $request->status,
                "note" => $request->note
            ]);

            return response()->json([
                "status" => true,
                "message" => "Data '$request->name_project', berhasil dibuat."
            ]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
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
        $getOneById = WeeklyReport::find($id);

        return response()->json(["status" => true, "data" => $getOneById]);
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
        $weekly_reports = WeeklyReport::findOrFail($id);

        try {
            $validate=Validator::make($request->all(),[
                "code_project" => "required|string|max:100",
                "name_client" => "required|string|max:100",
                "name_project" => "required|string|max:200",
                "job_essay" => "required|string|max:100",
                "start_date" => "required|string|max:200",
                "end_date" => "required|string|max:200",
                "status" => "required|string|max:200",
                "note" => "required|string|max:200",
            ],[
                "code_project.required" => "Kode Project berhasil dibuat!",
                "name_client.required" => "Nama Client berhasil dibuat!",
                "name_project.required" => "Nama Project berhasil dibuat!",
                "job_essay.required" => "Uraian Pekerjaan berhasil dibuat!",
                "status.required" => "Status berhasil dibuat!",
                "note.required" => "Note berhasil dibuat!",
            ]);

            if ($validate->fails()) {
                return response()->json($validate->errors());
            }

            $weekly_reports->update([
                "code_project" => $request->code_project,
                "name_client" => $request->name_client,
                "name_project" => $request->name_project,
                "job_essay" => $request->job_essay,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "status" => $request->status,
                "note" => $request->note
            ]);

            return response()->json([
                "status" => true,
                "message" => "Data '$weekly_reports->name_project', berhasil diubah."
            ]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
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
        $weekly_reports = WeeklyReport::find($id);
        $weekly_reports -> delete();

        return response()->json([
            "status" => true, 
            "message" => "data '$weekly_reports->name_project' telah dihapus!"
        ]);
    }
}
