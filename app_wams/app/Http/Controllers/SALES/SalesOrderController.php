<?php

namespace App\Http\Controllers\SALES;

use App\Exports\SoExport;
use App\Http\Controllers\Controller;
use App\Models\Amount;
use App\Models\CreateNomerTableOrderOpty;
use App\Models\ListProjectAdmin;
use App\Models\NomerForOrderOpty;
use App\Models\NomerKodeProjectOrderOpties;
use App\Models\ProductItem;
use App\Models\Produk;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use App\Models\Sbu;
use App\Models\UserHasListProjectAdmin;
use App\Models\Wodlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use PDF;

class SalesOrderController extends Controller
{    
    public function index()
    {
        // $products = SalesOrder::whereIn('id', explode(",", $products->user_id))->get();
        $products = SalesOrder::orderBy('created_at', 'desc')->get();
        // foreach ($products as $key => $value) {
        //     // dd($value->file_dokumens);
        //     foreach ($value->file_dokumens as $key => $v) {
        //         dd($v->id);
        //     }
        // }
        // $c = 'mmlmlml';
        // explode('', $c);
        return view('SALES.slsorder', [
            'products' => $products,
        ]);
        // $odr = SalesOrder::orderBy("created_at", "ASC")->paginate(10);
        // return view('SALES.slsorder', compact('odr'));
    }

    public function create()
    {
        $q = DB::table('sales_orders')->select(DB::raw('MAX(RIGHT(no_so,3)) as kode'));
        $dd = "";
        if ($q->count() > 0)
        {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $dd = sprintf("%03s", $tmp);
            }
        }   else
        {
            $dd = "001";
        }
        
        $lpa = Wodlist::with('sorder.userTechnikals.AM','sopty')->get();
        $prd = Produk::all();
        

        $pmLead = Role::with('users')->where("name", "PM")->get();
// 
        // const amsales = res.sorder.user_technikals.map(item => item.a_m.name)

        // foreach ($lpa as $key => $value) {
        //     return $value->sorder->userTechnikals;
        //     foreach ($value->sorder->userTechnikals as $key => $results) {
        //         return $results;
        //     }
        // }
        // foreach ($lpa as $key => $value) {
        //     return $value->projectSalesOrder;
        // }

        // dd($lpa);
        return view('SALES.create', compact('dd', 'lpa', 'prd', 'pmLead')); //, compact('kd')
    }

    public function store(Request $request)
    {

        try {
            $validate = Validator::make($request->all(), [
                "project" => "required|string",
                "tgl_so" => "required|string",
                // "institusi" => "required|string|max:30",
                // "estimated_amount" => "required|string|max:30",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

        if ($validate->fails()) {
            return back()->with('error', 'Project Sudah ada atau field belum diisi');
        }

        $file_PHD = $request->file('file_PHD');
        $file_PHD_ext = $file_PHD->getClientOriginalName();
        $file_PHD_name = time(). $file_PHD_ext;
        $file_PHD_path = public_path('DocumentLTO/');
        $file_PHD->move($file_PHD_path, $file_PHD_name);
        
        $file_SPSC = $request->file('file_SPSC');
        $file_SPSC_ext = $file_SPSC->getClientOriginalName();
        $file_SPSC_name = time(). $file_SPSC_ext;
        $file_SPSC_path = public_path('DocumentLTO/');
        $file_SPSC->move($file_SPSC_path, $file_SPSC_name);
        
        $file_PS = $request->file('file_PS');
        $file_PS_ext = $file_PS->getClientOriginalName();
        $file_PS_name = time(). $file_PS_ext;
        $file_PS_path = public_path('DocumentLTO/');
        $file_PS->move($file_PS_path, $file_PS_name);

        $data1=$request->all();

        $pd = $request->product_name;

        $am = $request->title;

        $time = new SalesOrder;

        $time->no_so = $data1['no_so'];
        $time->kode_project = $data1['kode_project'];
        $time->institusi = $data1['institusi'];
        $time->project = $data1['project'];
        $time->tgl_so = $data1['tgl_so'];
        $time->file_project = $data1['file_project'];
        $time->file_PHD = $data['file_PHD'] = $file_PHD_name;
        $time->file_SPSC = $data['file_SPSC'] = $file_SPSC_name;
        $time->file_PS = $data['file_PS'] = $file_PS_name;
        $time->distributor = $data1['distributor'];
        $time->principal = $data1['principal'];
        $time->sbu = $data1['sbu'];
        $time->listpipe_id = $data1['listpipe_id'];
        $time->listadmin_id = $data1['listadmin_id'];
        $time->presales = $data1['presales'];
        $time->amsales = $data1['amsales'];
        $time->no_customer = $data1['no_customer'];
        $time->estimated_amount = $data1['estimated_amount'];
        $time->confidence_level = $data1['confidence_level'];
        $time->contract_amount = $data1['contract_amount'];
        $time->status_project = $data1['status_project'];
        // $time->total = $data1['totalSO'];
        // $time->grandtotal = $data1['grandtotal'];
        $time->name_user = Auth::user()->name;
        $time->save();
        
        if ($pd !== null) {
            foreach ($data1['product_quantity'] as $item => $value) {
                $data2 = array(
                    'list_id' => $time->id,
                    'product_name' => $data1['product_name'][$item],
                    'product_quantity' => $data1['product_quantity'][$item],
                    'harga_product' => $data1['harga_product'][$item],
                    'total' => $data1['total'][$item],
                );
                ProductItem::create($data2);
            }
        }

        if ($am !== null) {
            foreach ($data1['title'] as $item => $value) {
                $data3 = array(
                    
                    'salesorders_id' => $time->id,
                    'title' => $data1['title'][$item],
                    'amount' => $data1['amount'][$item]
                
                );
                Amount::create($data3);
            }
        }

        return redirect('slsorder')->with('success', 'Berhasil Menambah Data');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id)
    {
        $shorder = SalesOrder::with('amdetail','pddetail')->find($id);
        $prd = Produk::all();
        return view('SALES.SOshow', compact('shorder','prd'));
    }
    
    public function salesorder_pdf($id)
    {
        $shorder = SalesOrder::with('amdetail','pddetail')->find($id);
        $pdf = PDF::loadview('SALES.soPDF',['shorder'=>$shorder]);
	    return $pdf->download('sales_order_SO.pdf');
        // return view('SALES.soPDF', compact('shorder'));
    }

    public function edit($id)
    {
        $product = SalesOrder::with('amdetail','pddetail')->find($id);
        $pmLead = Role::with('users')->where("name", "PM")->get();
        $sbu = Sbu::all();
        // foreach ($product->pm_lead as $key => $value) {
            
        //     return $value;
        // }
        // return $product->amdetail;
        // foreach ($product->amdetail as $key => $value) {
        //     return $value;
        // }
        return view('SALES.SOedit', ['product' => $product, 'sbu' => $sbu, 'pmLead' => $pmLead]);
        
        // $getOneById = SalesOrder::find($id);
        // return view('SALES.SOedit', compact('getOneById'));
    }

    public function update(Request $request, $id)
    {
        $time = SalesOrder::with('amdetail','pddetail')->find($id);
        try {
            $validate = Validator::make($request->all(), [
                "no_so" => "required|string",
                "institusi" => "required|string",
                "project" => "required|string",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

        if ($validate->fails()) {
            return back()->with('error', 'Please provide all value!');
        }

        $file_PHD = $request->file('file_PHD');

        if(!empty($file_PHD))
        {
            // dokumen
            $file_PHD_ext = $file_PHD->getClientOriginalName();
            $file_PHD_name = time(). $file_PHD_ext;
            $file_PHD_path = public_path('DocumentLTO/');
            $file_PHD->move($file_PHD_path, $file_PHD_name);
            if(!empty($time->file_PHD))
            {
                unlink('DocumentLTO/'.$time->file_PHD);
            }
        }
        else
        {
            $file_PHD_name = $time->file_PHD;
        }
        
        $file_SPSC = $request->file('file_SPSC');

        if(!empty($file_SPSC))
        {
            // dokumen
            $file_SPSC_ext = $file_SPSC->getClientOriginalName();
            $file_SPSC_name = time(). $file_SPSC_ext;
            $file_SPSC_path = public_path('DocumentLTO/');
            $file_SPSC->move($file_SPSC_path, $file_SPSC_name);
            if(!empty($time->file_SPSC))
            {
                unlink('DocumentLTO/'.$time->file_SPSC);
            }
        }
        else
        {
            $file_SPSC_name = $time->file_SPSC;
        }
        
        $file_PS = $request->file('file_PS');

        if(!empty($file_PS))
        {
            // dokumen
            $file_PS_ext = $file_PS->getClientOriginalName();
            $file_PS_name = time(). $file_PS_ext;
            $file_PS_path = public_path('DocumentLTO/');
            $file_PS->move($file_PS_path, $file_PS_name);
            if(!empty($time->file_PS))
            {
                unlink('DocumentLTO/'.$time->file_PS);
            }
        }
        else
        {
            $file_PS_name = $time->file_PS;
        }

        $data1=$request->all();

        $pd = $request->product_name;

        $am = $request->title;
        
        $time->no_so = $data1['no_so'];
        $time->kode_project = $data1['kode_project'];
        $time->institusi = $data1['institusi'];
        $time->project = $data1['project'];
        $time->tgl_so = $data1['tgl_so'];
        $time->file_project = $data1['file_project'];
        $time->file_PHD = $data['file_PHD'] = $file_PHD_name;
        $time->file_SPSC = $data['file_SPSC'] = $file_SPSC_name;
        $time->file_PS = $data['file_PS'] = $file_PS_name;
        $time->distributor = $data1['distributor'];
        $time->principal = $data1['principal'];
        $time->pmo = $data1['pmo'];
        $time->sbu = $data1['sbu'];
        $time->presales = $data1['presales'];
        $time->amsales = $data1['amsales'];
        $time->no_customer = $data1['no_customer'];
        $time->estimated_amount = $data1['estimated_amount'];
        $time->contract_amount = $data1['contract_amount'];
        $time->status_project = $data1['status_project'];
        // $time->total = $data1['totalSO'];
        // $time->grandtotal = $data1['grandtotal'];
        $time->name_user = Auth::user()->name;
        $time->save();

        ProductItem::where('list_id', $id)->delete();

        if ($pd !== null) {
            foreach ($data1['product_quantity'] as $item => $value) {
                // $values = Value::where('project_id', $id)->get();
                $data2 = array(

                    'list_id' => $time->id,
                    'product_name' => $data1['product_name'][$item],
                    'product_quantity' => $data1['product_quantity'][$item],
                    'harga_product' => $data1['harga_product'][$item],
                    'total' => $data1['total'][$item],
                
                );
                ProductItem::create($data2);
            }
        }
        
        Amount::where('salesorders_id', $id)->delete();

        if ($am !== null) {
            foreach ($data1['title'] as $item => $value) {
                // $values = Amount::where('salesorders_id', $id)->get();
                $data3 = array(
                    
                    'salesorders_id' => $time->id,
                    'title' => $data1['title'][$item],
                    'amount' => $data1['amount'][$item]
                
                );
                Amount::create($data3);
            }
        }
        
        if (count($time->file_dokumens) > 0) {
            foreach ($time->file_dokumens as $media) {
                if (!in_array($media->file_name, $request->input('file_dokumen', []))) {
                    $media->delete();
                }
            }
        }

        return redirect('slsorder')->with('success', 'Berhasil Menambah Data');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        // return redirect()->route('products.index');
        // $update=SalesOrder::find($id);
    }

    public function destroy($id)
    {
        // $so = SalesOrder::find($id)->delete();
        $so = SalesOrder::find($id);
        // $soidp = Wodlist::all();
        $am = Amount::all();
        $prd = ProductItem::all();
        
        foreach ($am as $key => $v) {
            $amid = $so->id; // 2 -> tabel salesorder

            if ($amid ==  $v->salesorders_id) {
                // return $v->id;
                Amount::find($v->id)->delete();
            }
        }

        foreach ($prd as $key => $val) {
            $prdid = $so->id; // 2 -> tabel salesorder

            if ($prdid ==  $val->list_id) {
                // return $val->id;
                ProductItem::find($val->id)->delete();
            }
        }

        $file_PHD = public_path().'/DocumentLTO/' . $so->file_PHD;
        unlink($file_PHD);
        
        $file_SPSC = public_path().'/DocumentLTO/' . $so->file_SPSC;
        unlink($file_SPSC);
        
        $file_PS = public_path().'/DocumentLTO/' . $so->file_PS;
        unlink($file_PS);

        $so->delete();
        // return $kdpo;

        // $hasilKodepProjectc =  substr($k,10); // 1
        // return $kdpo->id;

        // if ($k == $kdpo->id) {
        //      SalesOrder::find($id)->delete();
        //      NomerForOrderOpty::find($kdpo->id)->delete();
        // } else {
        //     dd('gagal');
        // }

        // return $kdpo;
        

        
        // $so -> delete();
        

        return redirect('slsorder')->with('success', 'Berhasil Hapus Data');;
    }

    public function addso(Request $request)
    {
        $id = $request->id;
        $data = Wodlist::with('sorder.userTechnikals.AM','sorder.userTechnikals.userPM','sorder.userTechnikals.userTechnikal','sopty.userTechnikalsPipe.userTechnikal','sopty.userTechnikalsPipe.userPM')->find($id);

        return response()->json($data);
    }
}
