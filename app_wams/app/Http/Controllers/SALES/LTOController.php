<?php

namespace App\Http\Controllers\SALES;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\Produk;
use App\Models\ProgressStatus;
use App\Models\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Symfony\Component\Console\Input\Input;

class LTOController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        // $products = SalesOrder::with('file_dokumens')->get();
        $products = SalesOrder::with(['bast' => function($q) use ($status)
        {
            $q->where('status', 'LIKE', '%' . $status . '%');

        }])->where('institusi', 'LIKE', '%' . $request->institusi . '%')
            ->where('name_user', 'LIKE', '%' . $request->name_user . '%')    
            ->get();
        $sales = Role::with('users')->where("name", "AM/Sales")->get();
        return view('SALES.ltodone', compact('products','sales'));
    }

    public function show($id)
    {
        $shorder = SalesOrder::with('file_dokumens','amdetail', 'pddetail', 'listtimeline.detail', 'listtimeline.detail.weeklies')->find($id);
        
        // foreach ($shorder->ltoproject as $key => $value) {
        //     # code...
        //     foreach ($value->listtimeline as $key => $val) {
        //         foreach ($val->detail as $key => $v) {
        //             return $v->weeklies;
        //             # code...
        //         }
        //         # code...
        //     }
        // }

        return view('SALES.ltoedit', compact('shorder'));
    }

    public function Addnote(Request $request, $id)
    {
        $time = SalesOrder::with('amdetail','pddetail')->find($id);
        try {
            $validate = Validator::make($request->all(), [
                // "no_so" => "required|string",
                // "institusi" => "required|string",
                // "project" => "required|string",
                // "no_doc" => "required|string|max:30|unique:sales_orders"
            ]);

        if ($validate->fails()) {
            return back()->with('error', 'Please provide all value!');
        }

        $data1=$request->all();

        $time->note_for_file1 = $data1['note_for_file1'];
        $time->note_for_file2 = $data1['note_for_file2'];
        $time->note_for_file3 = $data1['note_for_file3'];
        $time->save();

        return redirect('projectF')->with('success', 'Berhasil Tambah Note');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        // return redirect()->route('products.index');
        // $update=SalesOrder::find($id);
    }
}
