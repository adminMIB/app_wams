<?php

namespace App\Http\Controllers;


use App\Models\ListProjet;
use App\Models\ProjectTimeline;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $start_date = Carbon::parse($request->start_date)
        ->toDateTimeString();

        $end_date = Carbon::parse($request->end_date)
        ->toDateTimeString();

        $weekly_reports = WeeklyReport::with('listp')->orderBy('created_at', 'ASC')->whereBetween('created_at',[$start_date,$end_date])->get();
        $datas = ListProjet::all()->count();
        $data = ListProjet::with('detail')->get();
        $listp = ListProjet::all();
        
       

        return view('report.report_progres', compact('weekly_reports', 'data', 'listp', 'datas', 'post'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();
        $listp = ListProjet::with('detail')->get();
        // foreach ($listp as $key => $value) {
        //     foreach ($value->detail as $key => $v) {
        //         return $v->nama_technical;
        //     }
        // }
        $weekly_reports = WeeklyReport::all();
        return view('report.create', compact('weekly_reports', 'listp', 'data', 'datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $weekly_reports = $request->all();

        // dd($weekly_reports);

        // $weekly_reports = new WeeklyReport;

        if (count($weekly_reports['name_client'])) {
            foreach ($weekly_reports['start_date'] as $item => $value) {
                $weekly_reports2 = array(
                    'name_client' => $weekly_reports['name_client'][$item],
                    'name_project' => $weekly_reports['name_project'][$item],
                    'job_essay' => $weekly_reports['job_essay'][$item],
                    'start_date' => $weekly_reports['start_date'][$item],
                    'end_date' => $weekly_reports['end_date'][$item],
                    'status' => $weekly_reports['status'][$item],
                    'note' => $weekly_reports['note'][$item],
                    'listp_id' => $weekly_reports['listp_id'][$item],
                    'name_technikal' => Auth::user()->name,
                );

                WeeklyReport::create($weekly_reports2);
            }

            return redirect('report')->with('success', 'Weekly Report has been Added');
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
     * @return \Illuminate\Http\Respons
     */
    public function edit($id)
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();
        $getOneById = WeeklyReport::find($id);
        // dd($getOneById);
        return view('report.edit', compact('getOneById', 'data', 'datas'));
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
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();
        $lt = ProjectTimeline::all();
        // return $lt;
        return view('report.viewproject', compact('lt', 'data', 'datas'));
    }

    public function getOnePm(Request $request)
    {
        $id = $request->id;
        $data = ListProjet::find($id);
        return response()->json($data);
    }

    public function cetak_data()
    {
        $weekly_reports = WeeklyReport::all();
        return view('report.cetak_data', compact('weekly_reports'));
    }

    public function getDate(Request $request)
    {
        $start = Carbon::parse("$request->start_date 00:00:00")->format('Y-m-d H:i:s');
        $end = Carbon::parse("$request->end_date 23:59:59")->format('Y-m-d H:i:s');
        $product_packages = DB::table('weekly_reports')
            ->where([['start_date', '<=', $start], ['end_date', '>=', $end]])
            ->orwhereBetween('start_date', [$start, $end])
            ->orWhereBetween('end_date', [$start, $end])
        ;
        
        return redirect('report',compact('product_packages'));
    }

    // public function cari(Request $request)
    // {


    //     $start = Carbon::createFromFormat('Y-m-d', '2022-09-14');
    //     $end = Carbon::createFromFormat('Y-m-d', '2022-09-17');

    //     $search = WeeklyReport::query()->whereDate('start_date', '>=', $start)->whereDate('end_date', '<=', $end)->get();
    //     dd($search);




    //     // return view('report.report_progres',compact('weekly_reports'));




    //     // $start = Carbon::parse("$request->start_date 00:00:00")->format('Y-m-d H:i:s');
    //     // $end = Carbon::parse("$request->end_date 00:00:00")->format('Y-m-d H:i:s');
    //     // $weekly_reports = DB::table('weekly_reports')->where([['start_date', '<=', $start], ['end_date', '>=', $end]])->orWhereBetween('start_date', [$start, $end])->orWhereBetween('end_date', [$start, $end])->get();
    // }
}
