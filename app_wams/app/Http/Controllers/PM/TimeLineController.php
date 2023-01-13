<?php

namespace App\Http\Controllers\PM;
use App\Http\Controllers\Controller;
use App\Models\DokumenTimeline;
use App\Models\ListProjectTech;
use App\Models\ListProjet;
use App\Models\ProjectTimeline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ListToPm;
use App\Models\Produk;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use App\Models\Wodlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class TimeLineController extends Controller
{
    private $mediaCollection = 'upload_dokumen';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        // $datas = ListToPm::all()->count();
        // $data = ListToPm::all();
        if ($request->has('search')) {
            $time = ListProjet::orderBy('created_at', 'desc')->where('kode_project', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $time = ListProjet::orderBy('created_at', 'desc')->get();
            // $time = ProjectTimeline::with('lists')->get();
        }
        $so = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies')->find($id);
        $user = Role::with('users')->where('name', 'Technikal')->get();
        $pm = Role::with('users')->where('name', 'PM')->get();
        return view('timeline.timeline', compact('time','so','user','pm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // $datas = ListToPm::all()->count();
        // $data = ListToPm::all();
        $user = Role::with('users')->where('name', 'Technikal')->get();
        $pm = Role::with('users')->where('name', 'PM')->get();
        $cb = SalesOrder::find($id);

        return view('timeline.input', compact('cb', 'user','pm'));
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

            $data1=$request->all();

                $time = new ListProjet;
                $time->no_sales = $data1['no_sales'];
                $time->tgl_sales = $data1['tgl_sales'];
                $time->nama_sales = $data1['nama_sales'];
                $time->kode_project = $data1['kode_project'];
                $time->hps = $data1['hps'];
                $time->so_id = $data1['so_id'];
                $time->nama_institusi = $data1['nama_institusi'];
                $time->nama_project = $data1['nama_project'];
                $time->nama_dokumen = $data1['nama_dokumen'];
                $time->upload_dokumen =  implode("," , $request->upload_dokumen);
                $time->nama_pm = Auth::user()->name;
                $time->save();

                foreach ($request->input('upload_dokumen', []) as $file) {
                    $time->addMedia(public_path('tmp/upload_dokument/' . $file))->toMediaCollection($this->mediaCollection);
                }


            if (count($data1['nama_technical'])) {
                foreach ($data1['start_date'] as $item => $value) {
                    $data2 = array(
                        'list_id' => $time->id,
                        'start_date' => $data1['start_date'][$item],
                        'finish_date' => $data1['finish_date'][$item],
                        'jenis_pekerjaan' => $data1['jenis_pekerjaan'][$item],
                        'nama_technical' => $data1['nama_technical'][$item],
                    );

                    ProjectTimeline::create($data2);
                }

                return back()->with('success', 'Data Berhasil Di Simpan');
            }
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
        // $datas = ListToPm::all()->count();
        // $data = ListToPm::all();
        $time = ListProjet::with('detail')->where('id', $id)->first();
        return view('timeline.detail_timeline', compact('time',));
    }

    public function createnewtimeline($id)
    {
        // $datas = ListToPm::all()->count();
        // $data = ListToPm::all();
        $user = Role::with('users')->where('name', 'Technikal')->get();
        $time =  ListProjet::with('edit')->where('id', $id)->first();
        $t= ProjectTimeline::all();
        return view('timeline.addnewtimeline', compact('time', 'user','t','pm'));
    }

    public function addnewtimeline(Request $request, $id)
    {
        $time = ListProjet::with('detail')->find($id);

        $data1=$request->all();

        if (count($data1['nama_technical'])) {
            foreach ($data1['start_date'] as $item => $value) {
                $data2 = array(
                    'list_id' => $time->id,
                    'start_date' => $data1['start_date'][$item],
                    'finish_date' => $data1['finish_date'][$item],
                    'jenis_pekerjaan' => $data1['jenis_pekerjaan'][$item],
                    'nama_pm' => $data1['nama_pm'][$item],
                    'nama_technical' => $data1['nama_technical'][$item],
                );

                ProjectTimeline::create($data2);
            }

            return redirect('timeline')->with('success', 'Data Berhasil Di Simpan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $datas = ListToPm::all()->count();
        // $data = ListToPm::all();
        $user = Role::with('users')->where('name', 'Technikal')->get();
        $pm = Role::with('users')->where('name', 'PM')->get();
        $time =  ListProjet::with('edit')->where('id', $id)->first();
        $t= ProjectTimeline::all();
        return view('timeline.edittml', compact('time', 'user','t','pm'));
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
        $time = ListProjet::with('detail')->find($id);

        // ProjectTimeline::where('list_id', $id)->delete();

        $data = $request->all();

        // if (count($data['nama_technical'])) {
        //     foreach ($data['start_date'] as $item => $value) {
        //         $data2 = array(
        //             'list_id' => $time->id,
        //             'start_date' => $data['start_date'][$item],
        //             'finish_date' => $data['finish_date'][$item],
        //             'jenis_pekerjaan' => $data['jenis_pekerjaan'][$item],
        //             'nama_technical' => $data['nama_technical'][$item],
        //             'nama_pm' => $data['nama_pm'][$item],
        //         );

        //         ProjectTimeline::create($data2);
        //     }

        // }

        if (count($data['nama_technical'])) {
            foreach ($data['list_id'] as $item => $value) {
                // $data2 = array(
                    $list_id['id'] = $data['list_id'][$item];
                    $list_id['start_date'] = $data['start_date'][$item];
                    $list_id['finish_date'] = $data['finish_date'][$item];
                    $list_id['jenis_pekerjaan'] = $data['jenis_pekerjaan'][$item];
                    $list_id['nama_technical'] = $data['nama_technical'][$item];
                    $list_id['nama_pm'] = $data['nama_pm'][$item];
                // );

                DB::table('project_timelines')->where('id', $data['list_id'][$item])->update($list_id);
            }

            return redirect('timeline')->with('success', 'Data Berhasil Di Update');

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
        $hps= ProjectTimeline::find($id);
        $hps->delete();
        return back();
    }

    public function list(Request $request)
    {
        $id = $request->id;
        $data = SalesOrder::find($id);
        return response()->json($data);
    }

    public function ReportTimeline()
    {
        $rp = ListProjet::all();
        return view('timeline.report_timeline',compact('rp'));

    }

    public function ShowTimeline($id)
    {
        // $datas = ListToPm::all()->count();
        // $data = ListToPm::all();
        $rpt = ListProjet::with('detail')->where('id', $id)->first();
        return view('timeline.detail_report', compact('rpt',));
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/upload_dokument/');
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


}
