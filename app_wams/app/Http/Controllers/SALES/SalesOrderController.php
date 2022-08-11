<?php

namespace App\Http\Controllers\SALES;

use App\Exports\SoExport;
use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class SalesOrderController extends Controller
{
    private $mediaCollection = 'file_dokumen';
    
    public function index()
    {
        // $products = SalesOrder::whereIn('id', explode(",", $products->user_id))->get();
        $products = SalesOrder::all();
        // $c = 'mmlmlml';
        // explode('', $c);
        return view('SALES.slsorder', [
            'products' => $products,
            'mediaCollection' => $this->mediaCollection
        ]);
        // $odr = SalesOrder::orderBy("created_at", "ASC")->paginate(10);
        // return view('SALES.slsorder', compact('odr'));
    }

    public function create()
    {
        $q = DB::table('sales_orders')->select(DB::raw('MAX(RIGHT(no_so,5)) as kode'));
        $dd = "";
        if ($q->count()>0)
        {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $dd = sprintf("%05s", $tmp);
            }
        } else
        {
            $dd = "SO001";
        }
        $pmLead = Role::with('users')->where("name", "PM Lead")->get();
        $TechnikelLead = Role::with('users')->where("name", "Technikal Lead")->get();
        $odr = SalesOrder::all();
        $lpa = ListProjectAdmin::all();
        return view('SALES.create', compact('odr', 'dd', 'lpa', 'pmLead', 'TechnikelLead')); //, compact('kd')
    }

    public function store(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                "no_so" => "required|string|unique:sales_orders",
                "institusi" => "required|string|max:30",
                "project" => "required|string|max:30",
                "hps" => "required|string|max:30",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        $product = SalesOrder::create([
            'name_user' => Auth::user()->name,
            'no_so' => $request->no_so,
            'kode_project' => $request->kode_project,
            'institusi' => $request->institusi,
            'project' => $request->project,
            'hps' => $request->hps,
            'tgl_so' => $request->tgl_so,
            'listpa_id' => $request->listpa_id,
            'file_dokumen' => implode("," , $request->file_dokumen),
            'signPm_lead' => $request->signPm_lead,
            'signTeknikal_lead' => $request->signTeknikal_lead,
        ]);
        foreach ($request->input('file_dokumen', []) as $file) {
            $product->addMedia(public_path('tmp/uploads/' . $file));
        }

        // $so = new SalesOrder;
        // $so->name_user = Auth::user()->name;
        // $so->no_so = $request->no_so;
        // $so->kode_project = $request->kode_project;
        // $so->institusi = $request->institusi;
        // $so->project = $request->project;
        // $so->hps = $request->hps;
        // $so->tgl_so = $request->tgl_so;
        // $so->listpa_id = $request->listpa_id;
        // $so->file_dokumen = $request->file_dokumen = $name;
        // $so->signPm_lead = $request->signPm_lead;
        // $so->signTeknikal_lead = $request->signTeknikal_lead;
        // $so->save();

        return redirect('slsorder');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function storeMedia(Request $request)
    {
        $path = public_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function export()
    {
        // return Excel::download(new SoExport, 'salesOrder.xlsx');
    }

    public function edit($id)
    {
        $product = SalesOrder::with('pmLead', 'teknikalLead')->find($id);
        // foreach ($product->pm_lead as $key => $value) {
            
        //     return $value;
        // }
        // return $product->pm_lead->name;
        return view('SALES.SOedit', ['product' => $product, 'file_dokumens' => $product->getMedia($this->mediaCollection)]);
        
        // $getOneById = SalesOrder::find($id);
        // return view('SALES.SOedit', compact('getOneById'));
    }

    public function update(Request $request, $id)
    {
        $product = SalesOrder::with('file_dokumens')->find($id);
        try {
            $validate = Validator::make($request->all(), [
                "no_so" => "required|string",
                "institusi" => "required|string|max:30",
                "project" => "required|string|max:30",
                "hps" => "required|string|max:30",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }
        
        $product->no_so = $request->no_so;
        $product->institusi = $request->institusi;
        $product->project = $request->project;
        $product->hps = $request->hps;
        $product->file_dokumen = implode(",", $request->file_dokumen);
        $product->update();

        
        if (count($product->file_dokumens) > 0) {
            foreach ($product->file_dokumens as $media) {
                if (!in_array($media->file_name, $request->input('file_dokumen', []))) {
                    $media->delete();
                }
            }
        }
        
        $media = $product->file_dokumens->pluck('file_name')->toArray();
        
        foreach ($request->input('file_dokumen', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $product->addMedia(public_path('tmp/uploads/' . $file))->toMediaCollection($this->mediaCollection);
            }
        }
        
        return redirect('slsorder');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        // return redirect()->route('products.index');
        // $update=SalesOrder::find($id);
    }

    // public function destroy($id)
    // {
    //     $so = SalesOrder::find($id);

    //     $file_dokumen = public_path()."/tmp/uploads/".$so->file_dokumen;
    //     unlink($file_dokumen);

    //     $so -> delete();

    //     return redirect('slsorder');
    // }

    public function destroy($id)
    {
        $so = SalesOrder::find($id)->delete();

        // $file_dokumen = public_path().'/tmp/uploads/' . $so->file_dokumen;
        // unlink($file_dokumen);
        
        // $so -> delete();

        return redirect('slsorder');
    }

    public function addso(Request $request)
    {
        $id = $request->id;
        $data = ListProjectAdmin::find($id);
        return response()->json($data);
    }
}
