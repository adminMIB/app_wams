<?php

namespace App\Http\Controllers\viewControlerrSuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use App\Models\UploadDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SalesOrderControllerM extends Controller
{
    public function index()
    {
        $odr = SalesOrder::orderBy("created_at", "ASC")->paginate(10);
        return view('superAdmin.salesMonitoring.dashboardSalesOrder', compact('odr'));
    }

    public function create()
    {
        $q = DB::table('sales_orders')->select(DB::raw('MAX(RIGHT(no_so,3)) as kode'));
        $dd = "";
        if ($q->count()>0)
        {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $dd = sprintf("%03s", $tmp);
            }
        } else
        {
            $dd = "001";
        }
        $odr = SalesOrder::all();
        return view('superAdmin.salesMonitoring.addSalesOrder', compact('odr', 'dd')); //, compact('kd')
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "no_so" => "required|string|unique:sales_orders",
                "institusi" => "required|string|max:30",
                "project" => "required|string|max:30",
                "file_quotation" => "required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx",
                "file_po" => "required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx",
                "file_spk" => "required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx",
                "file_dokumen" => "required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx",
                "hps" => "required|string|max:30",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        $file_quotation = $request->file('file_quotation');
        $file_quotation_ext = $file_quotation->getClientOriginalName();
        $file_quotation_name = time(). $file_quotation_ext;
        $file_quotation_path = public_path('/files/quota');
        $file_quotation->move($file_quotation_path, $file_quotation_name);
        
        $file_po = $request->file('file_po');
        $file_po_ext = $file_po->getClientOriginalName();
        $file_po_name = time(). $file_po_ext;
        $file_po_path = public_path('/files/po');
        $file_po->move($file_po_path, $file_po_name);
        
        $file_spk = $request->file('file_spk');
        $file_spk_ext = $file_spk->getClientOriginalName();
        $file_spk_name = time(). $file_spk_ext;
        $file_spk_path = public_path('/files/spk');
        $file_spk->move($file_spk_path, $file_spk_name);
        
        $file_dokumen = $request->file('file_dokumen');
        $file_dokumen_ext = $file_dokumen->getClientOriginalName();
        $file_dokumen_name = time(). $file_dokumen_ext;
        $file_dokumen_path = public_path('/files/dokumen');
        $file_dokumen->move($file_dokumen_path, $file_dokumen_name);
        
 

        $so = new SalesOrder;
        $angka = $so->no_so = $request->no_so;
        $s = substr($angka, 11);
        
        // dd($s);
        $so->name_user = Auth::user()->name;
        $so->no_so = $request->no_so;
        $so->kode_project = $s;
        $so->institusi = $request->institusi;
        $so->project = $request->project;
        $so->hps = $request->hps;
        $so->file_quotation = $file_quotation_name;
        $so->file_po = $file_po_name;
        $so->file_spk = $file_spk_name;
        $so->jenis_dok = $request->jenis_dok;
        $so->file_dokumen = $file_dokumen_name;
        $so->save();
    
        
        // $nmq = $request->file_quotation;
        // $file_quotation = time().$nmq->getClientOriginalName();
        // $nmq->move(public_path().'/files/quota', $file_quotation);

        // $nmp = $request->file_po;
        // $file_po = time().$nmp->getClientOriginalName();
        // $nmp->move(public_path().'/files/po', $file_po);

        // $nms = $request->file_spk;
        // $file_spk = time().$nms->getClientOriginalName();
        // $nms->move(public_path().'/files/spk', $file_spk);
        
        // $nmd = $request->file_dokumen;
        // $file_dokumen = time().$nmd->getClientOriginalName();
        // $nmd->move(public_path().'/files/dokumen', $file_dokumen);
        
        // SalesOrder::create([
        //     "institusi" => $request->institusi,
        //     "project" => $request->project,
        //     "hps" => $request->hps,
        //     "file_quotation" => $request->upload = $file_quotation,
        //     "file_po" => $request->upload = $file_po,
        //     "file_spk" => $request->upload = $file_spk,
        //     "file_dokumen" => $request->upload = $file_dokumen,
        //     "status" => $request->status,
        //     // "no_doc" => $request->no_doc
        // ]);

        return redirect('/dashboard/salesOrder');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function export()
    {
        // return Excel::download(new SoExport, 'salesOrder.xlsx');
    }

    public function edit($id)
    {
        $getOneById = SalesOrder::find($id);

        return view('SALES.edit', compact('getOneById'));
    }

    public function update(Request $request, $id)
    {
        // $so = SalesOrder::findOrFail($id);
        $update=SalesOrder::find($id);
        try {
            $validate = Validator::make($request->all(), [
                "no_so" => "required|string",
                "institusi" => "required|string|max:30",
                "project" => "required|string|max:30",
                "file_quotation" => "mimes:doc,docx,pdf,xls,xlsx,ppt,pptx",
                "file_po" => "mimes:doc,docx,pdf,xls,xlsx,ppt,pptx",
                "file_spk" => "mimes:doc,docx,pdf,xls,xlsx,ppt,pptx",
                "file_dokumen" => "mimes:doc,docx,pdf,xls,xlsx,ppt,pptx",
                "hps" => "required|string|max:30",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        
        $file_quotation = $request->file('file_quotation');
        
        if(!empty($file_quotation))
        {
            // quotation
            $file_quotation_ext = $file_quotation->getClientOriginalName();
            $file_quotation_name = time(). $file_quotation_ext;
            $file_quotation_path = public_path('files/quota/');
            $file_quotation->move($file_quotation_path, $file_quotation_name);
            if(!empty($update->file_quotation))
            {
                unlink('files/quota/'.$update->file_quotation);
            }
            // $salt_image = bin2hex(openssl_random_pseudo_bytes(22));
            // $get_image_name = $salt_image.'.'.$file_quotation->getClientOriginalExtension();
            // $uplode_image_path = 'upload_file_path';
            // $file_quotation->move($uplode_image_path, $get_image_name);
            // if(!empty($update->filename))
            // {
            //     unlink('upload_file_path/'.$update->filename);
            // }
        }
        else
        {
            $file_quotation_name=$update->file_quotation;
        }

        $file_po = $request->file('file_po');
        
        if(!empty($file_po))
        {
            // po
            $file_po_ext = $file_po->getClientOriginalName();
            $file_po_name = time(). $file_po_ext;
            $file_po_path = public_path('files/po/');
            $file_po->move($file_po_path, $file_po_name);
            if(!empty($update->file_po))
            {
                unlink('files/po/'.$update->file_po);
            }
        }
        else
        {
            $file_po_name=$update->file_po;
        }

        $file_spk = $request->file('file_spk');
        
        if(!empty($file_spk))
        {
            // spk
            $file_spk_ext = $file_spk->getClientOriginalName();
            $file_spk_name = time(). $file_spk_ext;
            $file_spk_path = public_path('files/spk/');
            $file_spk->move($file_spk_path, $file_spk_name);
            if(!empty($update->file_po))
            {
                unlink('files/spk/'.$update->file_spk);
            }
        }
        else
        {
            $file_spk_name=$update->file_spk;
        }
        
        $file_dokumen = $request->file('file_dokumen');
        
        if(!empty($file_dokumen))
        {
            // dokumen
            $file_dokumen_ext = $file_dokumen->getClientOriginalName();
            $file_dokumen_name = time(). $file_dokumen_ext;
            $file_dokumen_path = public_path('files/dokumen/');
            $file_dokumen->move($file_dokumen_path, $file_dokumen_name);
            if(!empty($update->file_po))
            {
                unlink('files/dokumen/'.$update->file_dokumen);
            }
        }
        else
        {
            $file_dokumen_name=$update->file_dokumen;
        }

        $update->no_so = $request->no_so;
        $update->institusi = $request->institusi;
        $update->project = $request->project;
        $update->hps = $request->hps;
        $update->file_quotation = $file_quotation_name;
        $update->file_po = $file_po_name;
        $update->file_spk = $file_spk_name;
        $update->jenis_dok = $request->jenis_dok;
        $update->file_dokumen = $file_dokumen_name;
        $update->update();

        

        // $fileName = time().$request->file('file_quotation')->getClientOriginalName();
        // $file_quotation = $request->file('file_quotation')->store(substr('public/file/quotadisti', 22));
        // $file_po = $request->file('file_po')->store(substr('public/file/po', 14));
        // $file_spk = $request->file('file_spk')->store(substr('public/file/spk', 15));
        
        // $nmq = $request->file_quotation;
        // $file_quotation = time().$nmq->getClientOriginalName();
        // $nmq->move(public_path().'/files/quota', $file_quotation);

        // $nmp = $request->file_po;
        // $file_po = time().$nmp->getClientOriginalName();
        // $nmp->move(public_path().'/files/po', $file_po);

        // $nms = $request->file_spk;
        // $file_spk = time().$nms->getClientOriginalName();
        // $nms->move(public_path().'/files/spk', $file_spk);
        
        // $nmd = $request->file_dokumen;
        // $file_dokumen = time().$nmd->getClientOriginalName();
        // $nmd->move(public_path().'/files/dokumen', $file_dokumen);

        // if ($request->hasFile('file_quotation')) {
        //     unlink($file_quotation);

        //     $nmq = $request->file_quotation;
        //     $file_quotation = time().$nmq->getClientOriginalName();
        //     $nmq->move(public_path().'/files/quota', $file_quotation);
        // }

        // $so->update([
        //     "institusi" => $request->institusi,
        //     "project" => $request->project,
        //     "hps" => $request->hps,
        //     "file_quotation" => $request->upload = $file_quotation,
        //     "file_po" => $request->upload = $file_po,
        //     "file_spk" => $request->upload = $file_spk,
        //     "status" => $request->status,
        //     // "no_doc" => $request->no_doc
        // ]);

        return redirect('slsorder');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $so = SalesOrder::find($id);

        $file_quotation = public_path()."/files/quota/".$so->file_quotation;
        unlink($file_quotation);

        $file_po = public_path()."/files/po/".$so->file_po;
        unlink($file_po);

        $file_spk = public_path()."/files/spk/".$so->file_spk;
        unlink($file_spk);

        $file_dokumen = public_path()."/files/dokumen/".$so->file_dokumen;
        unlink($file_dokumen);

        $so -> delete();

        return redirect('slsorder');
    }
}