<?php

namespace App\Http\Controllers\Technical;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\ListProjet;
use App\Models\ProgressStatus;
use App\Models\ProjectTimeline;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use App\Models\TaskDiscussion;
use App\Models\Weekly;
use App\Models\WeeklyReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class WeeklyReportController extends Controller
{

    private $mediaCollection = 'UploadDocument';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $datas = ListProjet::all()->count();
        // $data = ListProjet::with('detail')->get();
        // $listp = ListProjet::all();
        // $weekly_reports = WeeklyReport::with('listp')->orderBy('created_at', 'ASC')->paginate();

        $weekly_reports = WeeklyReport::with('listp', 'projecttime')->orderBy('created_at', 'ASC')->paginate(0);
        $datas = ListProjet::all()->count();
        // $data = ListProjet::with('detail')->get();
        // $listp = ListProjet::all();
        if ($request->start || $request->end) {
            $start = Carbon::parse($request->start)->toDateTimeString();
            $end = Carbon::parse($request->end)->toDateTimeString();
            $data = ListProjet::with('detail')->whereBetween('created_at', [$start, $end])->get();
        } else {
            $data = ListProjet::with('detail')->orderBy('created_at', 'ASC')->paginate(5);

           
        }
        // return $data;
        // foreach ($data as $key => $value) {
        //     // return $value->detail;
        //     foreach ($value->detail as $key => $val) {
        //         return $val;
        //     }
        // }
        // if ($request->start || $request->end) {
        //     $start = Carbon::parse($request->start)->toDateTimeString();
        //     $end = Carbon::parse($request->end)->toDateTimeString();
        //     $weekly_reports = WeeklyReport::whereBetween('start_date', [$start, $end])->whereBetween('end_date', [$start, $end])->get();
        // } else {
        //     $weekly_reports = WeeklyReport::with('listp', 'projecttime')->orderBy('created_at', 'ASC')->paginate(5);
        // }
        // $datas = ListProjet::all()->count();
        // $data = ListProjet::with('detail')->get();
        $listp = ListProjet::all();
        $tk = ProjectTimeline::all();


        return view('report.report_progres', compact('weekly_reports', 'data', 'listp', 'datas','tk'));
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
        // return $listp;
        // foreach ($listp as $key => $value) {
        //     return $value->detail
        //     foreach ($value->detail as $key => $v) {
        //         return $v;
        //     }
        //     // return $value;
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
        try {
            $validate = Validator::make($request->all(), [
                "job_essay" => "required|string",
                "start_date" => "required|string",
                "end_date" => "required|string",
                "status" => "required|string",
                "note" => "required|string"
                // "institusi" => "required|string|max:30",
                // "estimated_amount" => "required|string|max:30",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

            if ($validate->fails()) {
                return back()->with('error', 'Field cannot be empty!');
            }

        $weekly_reports = $request->all();

        // dd($weekly_reports);

        // $weekly_reports = new WeeklyReport;


        Weekly::create([
            'listL_id' => $weekly_reports['listL_id'],
            'job_essay' => $weekly_reports['job_essay'],
            'start_date' => $weekly_reports['start_date'],
            'end_date' => $weekly_reports['end_date'],
            'status' => $weekly_reports['status'],
            'note' => $weekly_reports['note'],
            'name_technikal' => Auth::user()->name,
        ]);

        // $reports = new WeeklyReport;
        // $reports->name_client = $weekly_reports['name_client'];
        // $reports->name_project = $weekly_reports['name_project'];
        // $reports->listp_id = $weekly_reports['listp_id'];
        // $reports->name_technikal = Auth::user()->name;

        // $reports->save();

        // if (count($weekly_reports['job_essay'])) {
        //     foreach ($weekly_reports['start_date'] as $item => $value) {
        //         $weekly_reports2 = array(
        //             'listd_id' => $reports->id,
        //             'job_essay' => $weekly_reports['job_essay'][$item],
        //             'start_date' => $weekly_reports['start_date'][$item],
        //             'end_date' => $weekly_reports['end_date'][$item],
        //             'status' => $weekly_reports['status'][$item],
        //             'note' => $weekly_reports['note'][$item],
        //             'name_technikal' => Auth::user()->name,
        //         );

        //     }

        //     // dd($weekly_reports);
        // }
        return back()->with('success', 'Weekly Report has been Added');

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
        // $datas = ListProjet::all()->count();
        // $data = ListProjet::all();
        // $time =  WeeklyReport::with('editp')->where('id', $id)->first();
        // $weelys = Weekly::all();
        $user = Role::with('users')->where('name', 'Technikal')->get();
        // $pm = Role::with('users')->where('name', 'PM')->get();
        $time =  ListProjet::with('detail')->where('id', $id)->first();
        $t= Weekly::all();


        // foreach ($time->detail as $key => $value) {
        //     foreach ($value->weeklies as $key => $val) {
        //         return $val->listd_id;
        //     }
        // }
        // dd($getOneById);
        return view('report.edit', compact('time', 'user','t'));
    }

    public function detail($id)
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();
        $user = Role::with('users')->where('name', 'Technikal')->get();
        $time =  ListProjet::with('detail.weeklies')->where('id', $id)->first();
        $t = Weekly::all();

        return view('report.detail', compact('time', 'user','t', 'data', 'datas',));
    }

    public function detailpt($id)
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();
        $p = ListProjet::with('userpm')->where('id', $id)->first();
        $pp = ProjectTimeline::all();

        return view('report.detailtime', compact('p', 'data', 'datas', 'pp'));
    }

    public function detailso($id)
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();
        $so = SalesOrder::with('amdetail', 'pddetail')->where('id', $id)->first();


        return view('report.detailso', compact('so', 'data', 'datas'));
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
        $time = Weekly::find($id);

        $weekly_reports = $request->all();

        $time->job_essay = $weekly_reports['job_essay'];
        $time->start_date = $weekly_reports['start_date'];
        $time->end_date = $weekly_reports['end_date'];
        $time->status = $weekly_reports['status'];
        $time->note = $weekly_reports['note'];
        $time->save();
        
        return redirect('report')->with('success', 'Data Report berhasil di Ubah');
    
        // dd($time);
        // Weekly::where('listd_id', $id)->delete();

        // $data = $request->all();

        // if (count($data['job_essay'])) {
        //     foreach ($data['start_date'] as $item => $value) {
        //         $data2 = array(
        //             'listd_id' => $time->id,
        //             'start_date' => $data['start_date'][$item],
        //             'end_date' => $data['end_date'][$item],
        //             'job_essay' => $data['job_essay'][$item],
        //             'note' => $data['note'][$item],
        //             'status' => $data['status'][$item],
        //         );

        //         Weekly::create($data2);
        //     }

        //     return redirect('report')->with('success', 'Data Berhasil Di Update');
        // }

        // $getOneById = Weekly::with('edity')->where('id', $id)->first();
        // $getOneById->update($request->all());
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
        $weekly = Weekly::all();
        $wrid = $weekly_reports->id;

        foreach ($weekly as $key => $v) {
            if ($wrid ==  $v->listd_id) {
                Weekly::find($v->id)->delete();
            }
        }

        $weekly_reports->delete();

        return redirect('report')->with('success', 'Weekly Report Berhasil di hapus');
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

    public function view(Request $request)
    {
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $lt = ListProjectAdmin::orderBy('created_at', 'desc')->whereBetween('created_at', [$dari_tgl, $sampai_tgl])->get();
            $pipe = SalesOpty::orderBy('created_at', 'desc')->whereBetween('created_at', [$dari_tgl, $sampai_tgl])->get();
        } else {
            $lt = ListProjectAdmin::orderBy('created_at', 'desc')->with('userTechnikals.userTechnikal')->get();
            $pipe = SalesOpty::orderBy('created_at', 'desc')->with('userTechnikalsPipe.userTechnikal')->get();
        }

        return view('report.viewproject', compact('lt', 'pipe'));
    }

    public function viewPT(Request $request)
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();

        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $pt = ListProjet::with('userpm.userspm')->whereBetween('created_at', [$dari_tgl, $sampai_tgl])->get();
        } else {
            $pt = ListProjet::with('userpm.userspm')->get();
        }

        // $pt = ListProjet::with('userpm.userspm')->get();
        $tp = ProjectTimeline::all();

        return view('report.viewtime', compact('data', 'datas', 'pt', 'tp'));
    }

    public function viewSO(Request $request)
    {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();

        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $so = SalesOrder::orderBy('created_at', 'desc')->with('amdetail', 'pddetail')->whereBetween('created_at', [$dari_tgl, $sampai_tgl])->get();
        } else {
            $so = SalesOrder::orderBy('created_at', 'desc')->with('amdetail', 'pddetail')->get();
        }

        // $so = SalesOrder::with('amdetail', 'pddetail')->get();
        $tp = ProjectTimeline::all();

        return view('report.sales_order', compact('data', 'datas', 'so', 'tp'));
    }

    public function getOnePm(Request $request)
    {
        $id = $request->id;
        $data = ListProjet::with('weeklyreport')->find($id);
        return response()->json($data);
    }

    // public function getOnePt(Request $request)
    // {
    //     $id = $request->id;
    //     $data = ProjectTimeline::find($id);
    //     return response()->json($data);
    // }



    public function pipeline(Request $request)
    {
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $lt = ListProjectAdmin::whereBetween('created_at', [$dari_tgl, $sampai_tgl])->get();
            $pipe = SalesOpty::whereBetween('created_at', [$dari_tgl, $sampai_tgl])->get();
        } else {
            $lt = ListProjectAdmin::with('userTechnikals.userTechnikal')->get();
            $pipe = SalesOpty::with('userTechnikalsPipe.userTechnikal')->get();
        }

        return view('report.sales_pipeline', compact('lt','pipe'));
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/uploads');
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }


    public function lists($id)
    {
        $getOneById = ListProjectAdmin::find($id);
        return view('report.edit_list', [
            'getOneById' => $getOneById,
            'UploadDocuments' => $getOneById->getMedia($this->mediaCollection),
        ]);
    }
    
    public function listspipe($id)
    {
        $getOneById = SalesOpty::find($id);
        return view('report.edit_listpipe', [
            'getOneById' => $getOneById,
            'UploadDocuments' => $getOneById->getMedia($this->mediaCollection),
        ]);
    }

    public function updateadmin(Request $request, $id)
    {
        $updateData = ListProjectAdmin::with('UploadDocuments')->find($id);

        $updateData->update([
            "UploadDocument" =>  implode(",", $request->UploadDocument),
        ]);

        if (count($updateData->UploadDocuments) > 0) {
            foreach ($updateData->UploadDocuments as $media) {
                if (!in_array($media->file_name, $request->input('UploadDocument', []))) {
                    $media->delete();
                }
            }
        }

        $media = $updateData->UploadDocuments->pluck('file_name')->toArray();

        foreach ($request->input('UploadDocument', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $updateData->addMedia(public_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }

        return redirect('/viewproject')->with('success', 'berhasil menambah proposal');
    }
    
    public function updatepipe(Request $request, $id)
    {
        $updateData = SalesOpty::with('UploadDocuments')->find($id);

        $updateData->update([
            "UploadDocument" =>  implode(",", $request->UploadDocument),
        ]);

        if (count($updateData->UploadDocuments) > 0) {
            foreach ($updateData->UploadDocuments as $media) {
                if (!in_array($media->file_name, $request->input('UploadDocument', []))) {
                    $media->delete();
                }
            }
        }

        $media = $updateData->UploadDocuments->pluck('file_name')->toArray();

        foreach ($request->input('UploadDocument', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $updateData->addMedia(public_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }

        return redirect('/viewproject')->with('success', 'berhasil menambah proposal');
    }

    public function cetak()
    {
        $weekly = WeeklyReport::all();
        return view('report.cetak_data', compact('weekly'));
    }



    // public function getDate(Request $request)
    // {
    //     if ($request->start || $request->end) {
    //         $start = Carbon::parse($request->start)->toDateTimeString();
    //         $end = Carbon::parse($request->end)->toDateTimeString();
    //         $sales = WeeklyReport::whereBetween('created_at', [$start, $end])->get();
    //     } else {
    //         $sales = WeeklyReport::all();
    //     }
    //     return view('report.report_progres', compact('sales'));
    // }



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

        public function projects()
        {
            $p = SalesOrder::all();
            return view('report.project',compact('p'));
        }

        
        public function ViewP($id)
        {
            $shorder = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies')->find($id);
            $user = Role::with('users')->where('name', 'Technikal')->get();
            $edit = Weekly::find($id);    
            return view('report.view',compact('shorder','user','edit'));
        }

        public function updateItems(Request $request)
        {
            $input = $request->all();
    
            if(!empty($input['panddingArr']))
            {
                
            foreach ($input['panddingArr'] as $key => $value) {
                $key = $key+1;
                Weekly::where('id',$value)->update(['status'=>0]);
            }
    
            }
    
            if(!empty($input['completeArr']))
            {
                foreach ($input['completeArr'] as $key => $value) {
                    $key = $key+1;
                    Weekly::where('id',$value)->update(['status'=>1,]);
                }
            }
    
            if(!empty($input['doneArr']))
            {
                foreach ($input['doneArr'] as $key => $value) {
                    $key = $key+1;
                    Weekly::where('id',$value)->update(['status'=>2,]);
                }
            }
            
    
            return response()->json(['status'=>'success']);
        }

        public function showtask($id)
        {
            $data= Weekly::find($id);
            return view('report.edit1',compact('data'));
        }

        public function storetask(Request $request)
        {
            $request->request->add(['user_id'=> auth()->user()->id]);
            $dc = TaskDiscussion::create($request->all());
            return redirect()->back();
        }

        public function updateDes(Request $request,$id)
        {
            $time = Weekly::find($id);

            $weekly_reports = $request->all();
            $time->note = $weekly_reports['note'];
            $time->save();
            
            return redirect()->back()->with('success', 'Data Report berhasil di Ubah');
        }
            
        
}
