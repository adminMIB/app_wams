<?php
namespace App\Http\Controllers\PM;
use App\Http\Controllers\Controller;
use App\Exports\TaskExport;
use Illuminate\Http\Request;
use App\Models\Coba;
use App\Models\ListToPm;
use App\Models\SalesOrder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Task;
use App\Models\Weekly;
use App\Models\WeeklyReport;
use Carbon\Carbon;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        // $cb = Coba::paginate();
        // if ($request->has('cari')) {
        //     $cb = Coba::where('created_at', 'LIKE', '%' . $request->cari . '%')->get();
        // } //
        // //else{
        // //      $cb = Coba::paginate(3);
        // //  }
        // $datac = ListToPm::all()->count();
        // $data = ListToPm::all();
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $datas = Weekly::with('timelines.lists')->whereBetween('created_at', [$dari_tgl,$sampai_tgl])->where('status', 'like', "%" . $request->status . "%")->get();
        } else {
            $datas = Weekly::with('timelines.lists')->get();
        }
        $task = SalesOrder::find($id);
        // return $datas;
       
        return view('task', compact('datas','task'));
        // }
    }

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
        //
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
