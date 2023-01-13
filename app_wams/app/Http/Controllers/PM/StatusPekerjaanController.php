<?php

namespace App\Http\Controllers\PM;
use App\Http\Controllers\Controller;

use App\Models\Weekly;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Week;

class StatusPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Weekly::with('timelines.lists')->where('status','OnProgress')->get();
        return view('statustechnikal.on_progress',compact('datas'));
    }

    public function indexIs()
    {
        $datas = Weekly::with('timelines.lists')->where('status','Issue')->get();
        return view('statustechnikal.issue',compact('datas'));
    }

    public function indexDN()
    {
        $datas = Weekly::with('timelines.lists')->where('status','Done')->get();
        return view('statustechnikal.done',compact('datas'));
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
