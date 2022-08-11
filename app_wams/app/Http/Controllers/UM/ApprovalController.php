<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\ListProjectPm;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApprovalController extends Controller
{
    public function index()
    {
        $datas = SalesOrder::all()->count();
        $data = SalesOrder::all();
        $cekPmLead = ListProjectPm::all();
        // return $cekPmLead;

        return view('UM.approval', compact('datas', 'data', 'cekPmLead'));
    }

    public function show($id, Request $request)
    {
        $detailId = SalesOrder::find($id);
        $datas = SalesOrder::all()->count(); 

       

        return view('UM.detailapproval', compact('detailId', 'datas'));
        // return $detailId;

    }

    public function inputWo($id)
    {
        $detailId = SalesOrder::find($id);
        $datas = SalesOrder::all()->count();
        $data = SalesOrder::all();
        // $listPm = ListProjectPm::all();

        return view('UM.inputwo', compact('detailId', 'datas', 'data'));
    }

    public function edit($id)
    {
        $detailId = SalesOrder::find($id);

        return view('SALES.SOedit', compact('getOneById'));
    }

    public function update(Request $request, $id)
    {

        // $so = SalesOrder::findOrFail($id);
        $update=SalesOrder::find($id);
        try {
        $update->status = $request->status;
        $update->update();  

        return redirect('approval');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


}
