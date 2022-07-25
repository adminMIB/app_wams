<?php

namespace App\Http\Controllers\viewControlerrSuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use App\Models\UploadDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesOrderControllerM extends Controller
{
    public function index()
    {
        $q = DB::table('sales_orders')->select(DB::raw('MAX(RIGHT(id,2)) as kode'));
        $kd = "";
        {
            $kd = "00";
        }
        $up = UploadDocument::all();
        $odr = SalesOrder::with('uploaddoc')->orderBy("created_at", "ASC")->simplePaginate(10);
        return view('superAdmin.salesMonitoring.dashboardSalesOrder', compact('odr', 'up', 'kd'));
    }

    public function create()
    {
        // $q = DB::table('sales_orders')->select(DB::raw('MAX(RIGHT(,3)) as kode'));
        // $dd = "";
        // if ($q->count()>0)
        // {
        //     foreach ($q->get() as $k) {
        //         $tmp = ((int)$k->kode)+1;
        //         $dd = sprintf("%03s", $tmp);
        //     }
        // } else
        // {
        //     $dd = "001";
        // }
        // $odr = SalesOrder::all();
        // $up = UploadDocument::all();
        // compact('odr','up')
        return view('superAdmin.salesMonitoring.addSalesOrder'); //, compact('kd')
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "institusi" => "required|string|max:30",
                "project" => "required|string|max:30",
                "file_quotation" => "required|file",
                "file_po" => "required|file",
                "file_spk" => "required|file",
                "hps" => "required|string|max:30",
                "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

        if ($validate->fails()) {
            return back()->with('error','Field sudah ada atau tidak boleh kosong!');
        }

        // $fileName = time().$request->file('file_quotation')->getClientOriginalName();
        // $file_quotation = $request->file('file_quotation')->store(substr('public/file/quotadisti', 22));
        // $file_po = $request->file('file_po')->store(substr('public/file/po', 14));
        // $file_spk = $request->file('file_spk')->store(substr('public/file/spk', 15));

        $nmq = $request->file_quotation;
        $file_quotation = time().$nmq->getClientOriginalName();
        $nmq->move(public_path().'/files/quota', $file_quotation);

        $nmp = $request->file_po;
        $file_po = time().$nmp->getClientOriginalName();
        $nmp->move(public_path().'/files/po', $file_po);

        $nms = $request->file_spk;
        $file_spk = time().$nms->getClientOriginalName();
        $nms->move(public_path().'/files/spk', $file_spk);
        // $destinationPath = 'uploads';
        // $file = $request->file('file_quotation');
        // foreach($file as $singleFile){
        //     $original_name = strtolower(trim($singleFile->getClientOriginalName()));
        //     $file_name = time().rand(100,999).$original_name;
        //     // use one of following 
        //     $singleFile->move($destinationPath,$file_name); //public folder
        //     // $singleFile->storeAs('product',$file_name);  storage folder
        //     $fileArray[] = $file_name;
        // }

        SalesOrder::create([
            "institusi" => $request->institusi,
            "project" => $request->project,
            "hps" => $request->hps,
            "file_quotation" => $request->upload = $file_quotation,
            "file_po" => $request->upload = $file_po,
            "file_spk" => $request->upload = $file_spk,
            "status" => $request->status,
            "no_doc" => $request->no_doc
        ]);

        return redirect('slsorder');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    // public function export()
    // {
    //     return Excel::download(new SoExport, 'salesOrder.xlsx');
    // }
}