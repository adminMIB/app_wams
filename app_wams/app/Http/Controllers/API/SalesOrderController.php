<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Validation\Validator;

class SalesOrderController extends Controller
{
    public function index(Request $request)
    {
        $data = SalesOrder::orderBy("created_at", "DESC")->paginate(10);

        return response()->json([
            "status" => true,
            "data" => $data
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "no_so" => "required|string|max:30|unique:sales_orders",
                "tgl_order" => "required|string",
                "institusi" => "required|string|max:30",
                "project" => "required|string|max:30",
                "file_quotation" => "required|file",
                "file_po" => "required|file",
                "file_spk" => "required|file",
                "hps" => "required|string|max:30"
            ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
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
            "no_so" => $request->no_so,
            "tgl_order" => $request->tgl_order,
            "institusi" => $request->institusi,
            "project" => $request->project,
            "hps" => $request->hps,
            "file_quotation" => $request->upload = $file_quotation,
            "file_po" => $request->upload = $file_po,
            "file_spk" => $request->upload = $file_spk,
            "status" => $request->status
        ]);

        return response()->json([
            "status" => true,
            "message" => "berhasil dibuat"
        ]);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
