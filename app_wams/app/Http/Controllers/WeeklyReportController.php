<?php

namespace App\Http\Controllers;

use App\Models\ProjectTimeline;
use App\Models\WeeklyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WeeklyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $weekly_reports = WeeklyReport::where('start_date', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $weekly_reports = WeeklyReport::paginate(5);
        }


        return view('report.report_progres', compact('weekly_reports'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $weekly_reports = WeeklyReport::all();
        return view('report.create', compact('weekly_reports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "name_client" => "required|string|max:100",
                "name_project" => "required|string|max:200",
                "job_essay" => "required|string|max:200",
                "start_date" => "required|date",
                "end_date" => "required|date",
                "status" => "required|string|max:200",
                "note" => "required|string|max:1000",
            ], [


                "name_client.required" => "Kode Project harus sesuai!",
                "name_project.required" => "Nama Institusi harus sesuai!",
                "job_essay.required" => "Nama Project harus sesuai!",
                "start_date.required" => "Nama AM harus sesuai!",
                "end_date.required" => "HPS harus sesuai!",
                "status.required" => "Approve harus sesuai!",
                "note.required" => "Approve harus sesuai!",
            ]);

            if ($validate->fails()) {
                return redirect('create')->with('error', 'The column is still empty');
            }

            WeeklyReport::create([

                "name_client" => $request->name_client,
                "name_project" => $request->name_project,
                "job_essay" => $request->job_essay,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "status" => $request->status,
                "note" => $request->note,
            ]);


            return redirect('report')->with('success', 'The Weekly Report has been added');
        } catch (\Exception $r) {
            return redirect('report')->with('success', 'The Weekly Report has been added');
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
        //   $weekly_reports = WeeklyReport::find($id);

        //     return view('report.detail_page', compact('weekly_reports'));
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
        // dd($getOneById);
        return view('report.edit', compact('getOneById'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,)
    {
        $weekly_reports = WeeklyReport::find($id);
        $weekly_reports->update($request->all());
        return redirect('report')->with('success', 'The Weekly Report has been updated');
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
        $weekly_reports->delete();
        return redirect('report')->with('success', 'The Weekly Report has been deleted');
    }

    public function changeStatus($id)
    {
        $getStatus = WeeklyReport::select('status')->where('id', $id)->first();
        if ($getStatus->status == 'done  ') {
            $status = 'done';
        } elseif ('issue') {
            $status = 'issue';
        } else {
            $status = 'onprogress';
        }

        WeeklyReport::where('id', $id)->update(['status' => $status]);
        return redirect()->back();
    }

    public function view()
    {
        $lt = ProjectTimeline::all();
        return view('report.viewproject',compact('lt'));
    }
}
