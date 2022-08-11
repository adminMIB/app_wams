<?php

namespace App\Http\Controllers;

use App\Models\ListProjectTech;
use App\Models\ListProjet;
use App\Models\ProjectTimeline;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ListToPm;

class TimeLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = ListToPm::all()->count();
        $data = ListToPm::all();
        if ($request->has('search')) {
            $time = ListProjet::where('kode_project', 'LIKE', '%' . $request->search . '%')->get();
        } else {
            $time = ListProjet::all();
        }
        return view('timeline.timeline', compact('time', 'data', 'datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datas = ListToPm::all()->count();
        $data = ListToPm::all();
        $a = ListProjectTech::where('id', '=', 1)->first();
        $b = User::whereIn('id', explode(",", $a->user_id))->get();
        $time = ListProjectTech::all();

        return view('timeline.input', compact('time', 'b', 'data', 'datas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $time = new ListProjet;
        $time->no_sales = $data['no_sales'];
        $time->tgl_sales = $data['tgl_sales'];
        $time->nama_sales = $data['nama_sales'];
        $time->kode_project = $data['kode_project'];
        $time->hps = $data['hps'];
        $time->nama_institusi = $data['nama_institusi'];
        $time->nama_project = $data['nama_project'];
        $time->nama_pm = Auth::user()->name;
        $time->save();

        if (count($data['nama_technical'])) {
            foreach ($data['start_date'] as $item => $value) {
                $data2 = array(
                    'list_id' => $time->id,
                    'start_date' => $data['start_date'][$item],
                    'finish_date' => $data['finish_date'][$item],
                    'jenis_pekerjaan' => $data['jenis_pekerjaan'][$item],
                    'nama_technical' => $data['nama_technical'][$item],
                );

                ProjectTimeline::create($data2);
            }

            return redirect('timeline')->with('success', 'Data Berhasil Di Simpan');
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
        $datas = ListToPm::all()->count();
        $data = ListToPm::all();
        $time = ListProjet::with('detail')->where('id', $id)->first();
        return view('timeline.detail_timeline', compact('time', 'data', 'datas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = ListToPm::all()->count();
        $data = ListToPm::all();
        $a = ListProjectTech::where('id', '=', 1)->first();
        $b = User::whereIn('id', explode(",", $a->user_id))->get();
        $time =  ListProjet::with('edit')->where('id', $id)->first();
        return view('timeline.edittml', compact('time', 'data', 'datas', 'b'));
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

        ProjectTimeline::where('list_id', $id)->delete();

        $data = $request->all();

        if (count($data['nama_technical'])) {
            foreach ($data['start_date'] as $item => $value) {
                $data2 = array(
                    'list_id' => $time->id,
                    'start_date' => $data['start_date'][$item],
                    'finish_date' => $data['finish_date'][$item],
                    'jenis_pekerjaan' => $data['jenis_pekerjaan'][$item],
                    'nama_technical' => $data['nama_technical'][$item],
                );

                ProjectTimeline::create($data2);
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
        //
    }

    public function list(Request $request)
    {
        $id = $request->id;
        $data = ListProjectTech::find($id);
        return response()->json($data);
    }
}
