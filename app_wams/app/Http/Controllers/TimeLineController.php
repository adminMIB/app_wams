<?php

namespace App\Http\Controllers;

use App\Models\ListProject;
use App\Models\ListProjectTech;
use App\Models\ProjectTimeline;
use App\Models\User;
use Illuminate\Http\Request;

class TimeLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProjectTimeline::with('list_project_teches')->get();
        return view('timeline.timeline', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $a = ListProjectTech::where('id', '=', 1)->first();
        $b = User::whereIn('id', explode(",", $a->user_id))->get();
        $time = ListProjectTech::all();

        return view('timeline.input', compact('time', 'b'));
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

        // $time = new ProjectTimeline;
        // $time->start_date = $data['start_date'];
        // $time->finish_date = $data['finish_date'];
        // $time->jenis_pekerjaan = $data['jenis_pekerjaan'];
        // $time->nama_technical = $data['nama_tecnical'];

        if (count($data['nama_technical'])) {
            foreach ($data['start_date'] as $item => $value) {
                $data2 = array(
                    'start_date' => $data['start_date'][$item],
                    'finish_date' => $data['finish_date'][$item],
                    'jenis_pekerjaan' => $data['jenis_pekerjaan'][$item],
                    'nama_technical' => $data['nama_technical'][$item],
                );

                ProjectTimeline::create($data2);
            }
        }
        return redirect('input');
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
