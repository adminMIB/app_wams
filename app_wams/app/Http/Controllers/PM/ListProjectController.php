<?php
namespace App\Http\Controllers\PM;
use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\ListToPm;
use App\Models\Produk;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class ListProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $datas = ListToPm::all()->count();
        // $data = ListToPm::all();
        $bc = SalesOpty::all();
        $cb = ListProjectAdmin::all();
// return $cb;
        return view('listviewproject.list_project',compact('cb'));
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

    public function ViewSO()
    {
        $bc = SalesOrder::all();
        return view('listviewproject.list_so',compact('bc'));
    }

    public function DetailSO($id)
    {
        $dtorder = SalesOrder::with('amdetail','pddetail')->find($id);
        $prd = Produk::all();
        return view('listviewproject.detail_so',compact('dtorder','prd'));
    }

    public function ViewSP()
    {
        $sp = SalesOpty::all();
        return view('listviewproject.list_sp',compact('sp'));
    }

    public function DetailPA($id)
    {
        $pa = ListProjectAdmin::find($id);
        return view('listviewproject.detail_pa',compact('pa'));
    }

    public function DetailSP($id)
    {
        $sp = SalesOpty::find($id);
        return view('listviewproject.detail_sp',compact('sp'));
    }

}
