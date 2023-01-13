<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\ListProjectPm;
use App\Models\Produk;
use App\Models\SalesOrder;
use App\Models\Wodlist;
use App\Models\Wolist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $data = SalesOrder::orderBy('created_at', 'desc')->whereBetween('created_at', [$dari_tgl,$sampai_tgl])->paginate(10);
        } else {
            $data = SalesOrder::orderBy('created_at', 'desc')->paginate(10);
        }
        $datas = SalesOrder::all()->count();
        // $cekPmLead = ListProjectPm::all();
        // return $cekPmLead;

        return view('UM.approval', compact('datas', 'data'));
    }

    public function show($id, Request $request)
    {
        $datas = SalesOrder::all()->count(); 
        
        $dtorder = SalesOrder::with('listadmin', 'listpipe', 'amdetail','pddetail', 'bast', 'dokumen_projects')->find($id);
        // return $dtorder;
        $prd = Produk::all();

        // return $dtorder->listadmin->UploadDocument;

        return view('UM.detailapproval', compact('dtorder', 'datas', 'prd'));
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

    // public function statusReject(Request $request, $id ) {
    //     $update=SalesOrder::find($id);

    //     try {
    //         $update->status = $request->status;
    //         $update->note = $request->note;
    //         $update->update();
            
    
    //         return redirect('approval');
    //         } catch (\Exception $e) {
    //             return response()->json($e->getMessage());
    //         }
    // }

    public function update(Request $request, $id)
    {
        $update=SalesOrder::find($id);
        // dd($update->status == "Reject");

        // dd($request->status);
        

        // $so = SalesOrder::findOrFail($id);
        // $x = $update->id;
        // return $x;
    

        try {
            if ($request->status == "Approve") {
                $update->status = $request->status;
                $update->note = $request->note;
                $update->update();
                
            }
            
            if ($request->status == "Reject") {
                $update->status = $request->status;
                $update->note = $request->note;
                $update->update();
                
            }
            
            // if (!$update->note) {
            //     Wodlist::create([
            //         "status" => $request->status,
            //         "salesorder_id" => $request->salesorder_id,
            //         "salesopty_id" => $request->salesopty_id,
            //     ]);
            // }
            

        
        
        // if (!$update->note) {
        //     Wodlist::create([
        //         "status" => $request->status,
        //         "sign_pmLead" => $request->sign_pmLead,
        //         "sign_techLead" => $request->sign_techLead,
        //         "salesorder_id" => $request->salesorder_id,
        //         "salesopty_id" => $request->salesopty_id,
        //     ]);
        // }

        return redirect('approval')->with('success', 'data berhasil di '. $request->status);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


}
